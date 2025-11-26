<template>
  <v-card class="pa-4">
    <v-tabs
      v-model="tab"
      class="text-grey-darken-1 bg-blue-lighten-5"
      color="light-blue-darken-1"
    >
      <v-tab value="one" class="font-weight-medium">TECHNICHIAN FORM</v-tab>
    </v-tabs>
    <v-card-text>
      <v-virtual-scroll :items="[1]" height="530" item-height="auto">
        <template #default>
          <v-tabs-window v-model="tab">
            <v-tabs-window-item value="one">
              <div
                class="flex justify-between px-2 py-3 bg-blue-500 rounded-sm align-center"
              >
                <span class="font-semibold">FORM FOR TECHNICHIAN</span>
                <v-badge
                  location="top left"
                  color="error"
                  :content="data_count"
                  rounded="lg"
                >
                  <v-btn
                    rounded="xl"
                    class="text-blue-darken-4 bg-cyan-accent-1"
                    @click="dialog = true"
                  >
                    <template #prepend>
                      <i class="fa fa-file-alt fa-lg"></i>
                    </template>
                    <h1>ข้อมูลจาก Operator</h1>
                  </v-btn>
                </v-badge>
              </div>
              <div class="mt-3">
                <h1 class="text-xl text-red-500">
                  <i class="mr-2 fa-solid fa-circle-info"></i>ส่วนนี้จะเป็นของ
                  Technichian หรือ Model Change ที่จะต้องบันทึก
                  <span class="font-semibold"
                    ><mark class="text-red-500"
                      >(ข้อมูลที่ได้รับในการมาบันทึกนั้น ต้องหลังจาก Operator
                      กรอกข้อมูลเสร็จสิ้นเท่านั้น)</mark
                    >
                  </span>
                  โดยกดปุ่มข้อมูลจาก Operator
                  เพื่อทำการคลิกเลือกข้อมูลมากรอกข้อมูลด้านล่างนี้
                </h1>
                <p class="text-lg text-amber-500">
                  <i class="mr-2 fa-solid fa-circle-info"></i
                  >ตรวจสอบชื่อโปรแกรมบนหน้าจอเครื่องจักร ต้องตรงกับ Assembly
                  chart part list เท่านั้น
                </p>
              </div>
              <v-switch
                v-model="prs"
                :label="`Process: ${prs}`"
                false-value="CP"
                true-value="RF"
                hide-details
                color="blue"
              ></v-switch>
              <cpform
                v-if="prs === 'CP'"
                :id="id_select"
                :won_chn="won_select"
                :data_edit="_data"
                :model_chn="model_chn_select"
                :prgnm="prog_name_select"
                :cus="customer_select"
                :empno="empno"
              />
              <refform
                v-else
                :id="id_select"
                :won_chn="won_select"
                :model_chn="model_chn_select"
                :empno="empno"
                :data_edit="_data"
                :prgnm="prog_name_select"
                :cus="customer_select"
                :pcbno="pcbno_select"
              />
            </v-tabs-window-item>
          </v-tabs-window>
        </template>
      </v-virtual-scroll>
    </v-card-text>

    <v-dialog v-model="dialog" width="auto">
      <v-card min-width="1000">
        <template #prepend>
          <i class="fa fa-book fa-lg"></i>
        </template>
        <template #title>
          <h1>All Data From Operator</h1>
        </template>
        <v-card-title class="d-flex align-center pe-2">
          <i class="fa fa-box fa-lg"></i> &nbsp; ค้นหาข้อมูล Model Change

          <v-spacer></v-spacer>

          <v-text-field
            v-model="search"
            density="compact"
            label="Search"
            variant="solo-filled"
            flat
            hide-details
            single-line
          >
            <template #prepend-inner>
              <i class="fa fa-magnifying-glass"></i>
            </template>
          </v-text-field>
        </v-card-title>
        <v-divider></v-divider>
        <v-data-table
          :headers="headers"
          v-model:search="search"
          :filter-keys="['OPR_HREC_LINE']"
          density="compact"
          :items="data"
        >
          <template v-slot:item="{ item }">
            <tr class="text-no-wrap">
              <td>
                <div class="flex">
                  <div class="pa-2">
                    <v-btn color="blue" rounded @click="ChooseData(item)">
                      <template #prepend>
                        <i class="fa fa-check-square fa-lg"></i>
                      </template>
                      <h1 class="text-md">เลือก</h1>
                    </v-btn>
                  </div>
                </div>
              </td>
              <td style="min-width: 200px">
                {{ item.OPR_HREC_ISSUENO.split("-").pop().slice(3) }}
              </td>
              <td style="min-width: 100px">{{ item.OPR_HREC_PROCS }}</td>
              <td style="min-width: 100px">{{ item.OPR_HREC_LINE }}</td>
              <td style="min-width: 200px">{{ item.OPR_HREC_WON_CURRENT }}</td>
              <td style="min-width: 200px">{{ item.OPR_HREC_CURMDLNM }}</td>
              <td style="min-width: 200px">{{ item.OPR_HREC_WON_CHANGE }}</td>
              <td style="min-width: 200px">{{ item.OPR_HREC_CHNMDLNM }}</td>
            </tr>
          </template>
        </v-data-table>

        <template v-slot:actions>
          <v-btn class="ms-auto" text="Close" @click="dialog = false"></v-btn>
        </template>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import cpform from "~/components/cpform.vue";
import refform from "~/components/refform.vue";
import axios from "axios";

definePageMeta({
  layout: "custom",
});

const { public: config } = useRuntimeConfig();
console.log(config.apiBase);

const user = ref<any>(null);

/**
 *  TODO: เรียกข้อมูล session ผู้ใช้งาน
 */
const sessionUser = async () => {
  const res = await axios.get(`${config.apiBase}/session/user`, {
    withCredentials: true, // ต้องใส่ เพื่อส่ง laravel_session cookie
  });

  user.value = res.data;
  console.log("user session:", user.value);
  empno.value = user.value.empno;
};

/**
 * TODO: สร้างตัวแปรรับค่าจาก v-model on template
 */

const prs = ref<string>("");
const dialog = ref<boolean>(false);
const tab = ref<string>("one");
const search = ref<string>("");
const won_select = ref<string>("");
const model_chn_select = ref<string>("");
const id_select = ref<string>("");
const empno = ref<string>("");
const customer_select = ref<string>("");
const prog_name_select = ref<string>("");
const pcbno_select = ref<string>("");

const data = ref<any>([]);
const data_count = ref<number>(0);

const _data = ref<any>([]);
// ดึงข้อมูลจาก localStorage (เป็น string)
const stored = localStorage.getItem("data");

// ถ้ามีข้อมูล → แปลงเป็น object
if (stored) {
  _data.value = JSON.parse(stored);
} else {
  _data.value = []; // ถ้าไม่มีข้อมูล ให้เป็น array เปล่า
}

console.log("_data:", _data.value);

prs.value = _data.value.OPR_HREC_PROCS;
console.log("prs:", prs.value);

/**
 * TODO: สร้าง function เรียกข้อมูลจาก api
 */
const GetRecordFromOperator = async () => {
  try {
    const res = await axios.get(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/oprform"
    );
    data.value = res.data;
    data_count.value = data.value.length;
  } catch (error) {
    console.log(error);
  }
};

/**
 * TODO: สร้างฟังก์ชันจากการกดปุ่ม
 */
const ChooseData = (obj: any) => {
  prs.value = obj.OPR_HREC_PROCS;
  won_select.value = obj.OPR_HREC_WON_CHANGE;
  model_chn_select.value = obj.OPR_HREC_CHNMDLNM;
  id_select.value = obj.OPR_HREC_ID;
  customer_select.value = obj.OPR_HREC_CUS;
  prog_name_select.value = obj.OPR_HREC_PRGMNM;
  pcbno_select.value = obj.OPR_HREC_PRGMREV;

  dialog.value = false;
};

/**
 * TODO:สร้าง array ทำหัวตาราง
 */
const headers = ref<any>([
  { title: "Actions", align: "center" },
  { title: "เลขเอกสาร", key: "OPR_HREC_ISSUENO" },
  { title: "Process", key: "OPR_HREC_PROCS" },
  { title: "Line", key: "OPR_HREC_LINE" },
  { title: "WO# เดิม", key: "OPR_HREC_WON_CURRENT" },
  { title: "Model เดิม", key: "OPR_HREC_CURMDLNM" },
  { title: "WO# ใหม่", key: "OPR_HREC_WON_CHANGE" },
  { title: "Model ใหม่", key: "OPR_HREC_CHNMDLNM" },
]);

onMounted(() => {
  GetRecordFromOperator();
  sessionUser();
});
</script>
