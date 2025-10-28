<template>
  <v-card>
    <v-data-iterator :items="filtered_data" :items-per-page="2" :search="search">
      <template v-slot:header>
        <v-toolbar class="px-2 bg-blue-lighten-2">
          <div class="flex justify-between align-center w-[500px]">
            <v-text-field
              v-model="search"
              density="comfortable"
              placeholder="Search"
              prepend-inner-icon="mdi mdi-magnify"
              style="max-width: 300px"
              variant="solo"
              clearable
              hide-details
            ></v-text-field>
            <v-text class="text-xl font-weight-bold"> Process: CP </v-text>
          </div>
          <!-- <p class="text-sm text-gray-500">
                        Logged in as: {{ user?.username }} (Permission: {{ user?.permission }})
                    </p> -->
        </v-toolbar>
      </template>

      <template v-slot:default="{ items }">
        <v-container class="pa-2" fluid>
          <v-row dense>
            <v-col v-for="item in items" :key="item.raw.OPR_HREC_ID" cols="auto" md="6">
              <v-card class="pb-3" border flat>
                <v-list-item class="mb-2 font-weight-bold">
                  <template v-slot:title>
                    <strong class="mb-2 text-h6"
                      >Document No. :{{ item.raw.OPR_HREC_ISSUENO }}</strong
                    >
                  </template>
                  <template v-slot:subtitle>
                    <table class="border border-blue-800">
                      <tbody>
                        <tr class="border">
                          <th class="w-40 text-left border pa-2 text-sky-800">LINE:</th>
                          <td class="px-2 text-sky-800">
                            {{ item.raw.OPR_HREC_LINE }}
                          </td>
                        </tr>
                        <tr class="border">
                          <th class="text-left border text-sky-800 w-30 pa-2">
                            วันที่บันทึก:
                          </th>
                          <td class="px-2 text-sky-800">
                            {{ dateFormat(item.raw.OPR_HREC_DATEREC) }}
                          </td>
                        </tr>

                        <tr class="border">
                          <th class="text-left border pa-2 text-sky-800 w-30">
                            Operator ID:
                          </th>
                          <td class="px-2 text-sky-800">
                            {{ item.raw.OPR_HREC_EMPNO }}
                          </td>
                        </tr>

                        <tr class="border">
                          <th class="text-left border pa-2 text-sky-800 w-30">
                            Technichian ID:
                          </th>
                          <td class="px-2 text-sky-800">
                            {{ item.raw.TEC_CPHREC_EMPNO }}
                          </td>
                        </tr>
                        <tr class="border">
                          <th class="text-left border pa-2 text-sky-800 w-30">
                            Work Order ที่จะเปลี่ยน:
                          </th>
                          <td class="px-2 text-sky-800">
                            {{ item.raw.OPR_HREC_WON_CHANGE }}
                          </td>
                        </tr>
                        <tr class="border">
                          <th class="text-left border pa-2 text-sky-800 w-30">
                            Model ที่จะเปลี่ยน:
                          </th>
                          <td class="px-2 text-sky-800">
                            {{ item.raw.OPR_HREC_CHNMDLNM }}
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </template>
                </v-list-item>

                <div class="px-4 d-flex justify-space-between">
                  <div class="d-flex align-center text-caption text-medium-emphasis me-1">
                    <!-- ถ้า permission = 1 -->
                    <v-btn
                      v-if="user?.permission == 1"
                      variant="flat"
                      color="success"
                      rounded="lg"
                      @click="goAppr(item.raw)"
                    >
                      <v-icon icon="mdi-check-bold" class="mr-2"></v-icon>
                      ยืนยันส่งอนุมัติ
                    </v-btn>

                    <!-- ถ้า permission = 9 -->
                    <v-btn
                      v-else-if="user?.permission == 9"
                      variant="flat"
                      color="success"
                      rounded="lg"
                      @click="updateAppr(item.raw)"
                    >
                      <v-icon icon="mdi-check-bold" class="mr-2"></v-icon>
                      อนุมัติ
                    </v-btn>
                    <v-btn variant="flat" color="error" rounded="lg" class="ms-2">
                      <v-icon icon="mdi mdi-keyboard-return" class="mr-2"></v-icon>
                      กลับไปแก้ไข</v-btn
                    >
                  </div>

                  <v-btn
                    variant="flat"
                    color="primary"
                    rounded="lg"
                    @click="togglePDF(item.raw)"
                  >
                    <v-icon icon="mdi mdi-file-pdf-box" class="mr-2"></v-icon>
                    View PDF
                  </v-btn>
                </div>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
        <cpdocs :data-item="selected_data_cp" />
      </template>

      <!-- เรียกใช้ cpdocs.vue -->

      <template v-slot:footer="{ page, pageCount, prevPage, nextPage }">
        <div class="justify-center d-flex align-center pa-4">
          <v-btn
            :disabled="page === 1"
            density="comfortable"
            icon="mdi mdi-menu-left"
            variant="tonal"
            rounded
            @click="prevPage"
          ></v-btn>

          <div class="mx-2 text-caption">Page {{ page }} of {{ pageCount }}</div>

          <v-btn
            :disabled="page >= pageCount"
            density="comfortable"
            icon="mdi mdi-menu-right"
            variant="tonal"
            rounded
            @click="nextPage"
          ></v-btn>
        </div>
      </template>
    </v-data-iterator>
  </v-card>
</template>
<script lang="ts" setup>
import { ref, onMounted, defineExpose } from "vue";
import axios from "axios";
import dayjs from "dayjs";
import cpdocs from "~/components/cpdocs.vue";
import Swal from "sweetalert2";

definePageMeta({
  layout: "custom",
});

/**
 * TODO: สร้างตัวแปรเพื่อรับค่า api และ v-model
 */
const search = ref<string>("");
const all_data = ref<any>([]);

interface DataItem {
  OPR_HREC_LINE?: string;
  OPR_HREC_DATEREC?: string;
  OPR_HREC_STATUSMDL?: string;
  OPR_HREC_CURMDLNM?: string;
  OPR_HREC_CHNMDLNM?: string;
}

const selected_data_cp = ref<DataItem | null>(null);
const app_data_cp = ref<any>(null);
const APP_LEV = ref<any>(null);
const APP_EMP = ref<any>(null);
const filtered_data = ref<AllDataItem[]>([]);
// const pdfGen = ref<InstanceType<typeof cpdocs> | null>(null)

interface AllDataItem {
  OPR_HREC_ID: string;
  OPR_HREC_SENDAPP_STD: number; // หรือ number ถ้าใน DB เป็น number
  // ... เพิ่ม field อื่น ๆ ตามต้องการ
}

interface AppDataItem {
  APP_REC_LEVEL: string; // หรือ number
  APP_REC_EMPNO: string; // เช่น "1001,1002"
  // ... เพิ่ม field อื่น ๆ ตามต้องการ
}
/**
 * TODO: สร้างฟังก์ชันรับค่าจาก api
 */

const GetAllData = async () => {
  try {
    const res = await axios.get(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/alldata",
      {
        params: {
          empno: empno.value,
        },
      }
    );
    // console.log(res.data);
    all_data.value = res.data.cp;
    app_data_cp.value = res.data.app_cp;
    console.log(app_data_cp.value);

    // รีเซ็ตก่อน
    APP_LEV.value = null;
    APP_EMP.value = [];

    console.log("📦 All Data:", all_data.value);
    console.log("📋 Approval Data:", app_data_cp.value);

    // ✅ หาว่า empno อยู่ในสายอนุมัติไหน
    app_data_cp.value.forEach((appItem: AppDataItem) => {
      const level = appItem.APP_REC_LEVEL;

      const empIds = appItem.APP_REC_EMPNO
        ? appItem.APP_REC_EMPNO.split(",").map((e) => e.trim())
        : [];

      console.log(`🔹 Level: ${level}, EMP IDs:`, empIds);

      if (empIds.includes(empno.value)) {
        APP_LEV.value = level;
        APP_EMP.value = empIds;
        console.log(`✅ Match found: empno ${empno.value} in level ${level}`);
      }
    });

    console.log("✅ Final APP_LEV:", APP_LEV.value);
    console.log("✅ Final APP_EMP:", APP_EMP.value);

    filtered_data.value = all_data.value.filter((item: AllDataItem) => {
      const itemLevel = Number(item.OPR_HREC_SENDAPP_STD);

      if (APP_LEV.value === null) {
        // ⚠️ ถ้า APP_LEV ยัง null → แสดงเฉพาะ item ที่ level = 0
        if (itemLevel === 0) {
          console.log(`⚠️ APP_LEV null → แสดง item ${item.OPR_HREC_ID} (level 0)`);
          return true;
        }
        return false; // ไม่แสดง level อื่น
      }

      // ปกติ กรองตามสายอนุมัติของ user
      const matchedApp = app_data_cp.value.find(
        (app) => Number(app.APP_REC_LEVEL) === itemLevel
      );
      if (!matchedApp) return false;

      const empList = matchedApp.APP_REC_EMPNO.split(",").map((e) => e.trim());
      return empList.includes(empno.value.trim());
    });

    console.log("🎯 Filtered Data:", filtered_data.value);

    // all_data_rf.value = res.data.rf;
  } catch (error) {
    console.log(error);
  }
};

/**
 * TODO: สร้างฟังก์ชัน Event DOM
 *
 */

const dateFormat = (date: string) => {
  return dayjs(date).format("DD/MM/YYYY");
};

const togglePDF = async (item: DataItem) => {
  selected_data_cp.value = item;
  // console.log(selected_data_cp.value)
  // pdfGen.value?.createPdf()
};

/**
 * TODO:ฟังก์ชันส่งข้อมูลอนุมัติไปยังผู้อนุมัติ
 */

const goAppr = async (data: any) => {
  // console.log(data)

  const res = await axios.post(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/insert/approve",
    data
  );
  if (res.data.success === true) {
    Swal.fire({
      icon: "success",
      title: "ส่งอนุมัติสำเร็จ",
      showConfirmButton: false,
      timer: 1500,
    }).then(() => {
      location.reload();
    });
  }
};

const updateAppr = async (data: any) => {
  const payload = {
    ...data,
    APPROVE_BY: empno.value,
    APP_LEV: APP_LEV.value,
  };

  const res = await axios.put(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/update/approve",
    payload
  );
  console.log(res.data);
  // if (res.data.success === true) {
  //     Swal.fire({
  //         icon: "success",
  //         title: "อนุมัติสำเร็จ",
  //         showConfirmButton: false,
  //         timer: 1500,
  //     }).then(() => {
  //         location.reload();
  //     });
  // }
};

const { public: config } = useRuntimeConfig();
console.log(config.apiBase);

const user = ref<any>(null);
const empno = ref<string>("");

/**
 *  TODO: เรียกข้อมูล session ผู้ใช้งาน
 */
const sessionUser = async () => {
  const res = await axios.get(`${config.apiBase}/session/user`, {
    withCredentials: true, // ต้องใส่ เพื่อส่ง laravel_session cookie
  });

  user.value = res.data;
  console.log("user session:", user.value);
  empno.value = user.value?.empno || "";
};

onMounted(async () => {
  await sessionUser();
  await GetAllData();
});
</script>
