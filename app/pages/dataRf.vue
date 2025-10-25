<template>
  <v-card>
    <v-data-iterator :items="all_data_rf" :items-per-page="2" :search="search_rf" class="mt-2">
      <template v-slot:header>
        <v-toolbar class="px-2 bg-cyan-accent-3">
          <div class="flex justify-between align-center w-[500px]">
            <v-text-field v-model="search_rf" density="comfortable" placeholder="Search"
              prepend-inner-icon="mdi mdi-magnify" style="max-width: 300px" variant="solo" clearable
              hide-details></v-text-field>
            <v-text class="text-xl font-weight-bold"> Process: RF </v-text>
          </div>
        </v-toolbar>
      </template>

      <template v-slot:default="{ items }">
        <v-container class="pa-2" fluid>
          <v-row dense>
            <v-col v-for="item in items" :key="item.raw.OPR_HREC_ID" cols="auto" md="6">
              <v-card class="pb-3" border flat>
                <v-list-item class="mb-2 font-weight-bold">
                  <template v-slot:title>
                    <strong class="mb-2 text-h6">Document No. :{{ item.raw.OPR_HREC_ISSUENO }}</strong>
                  </template>
                  <template v-slot:subtitle>
                    <table class="border border-blue-800">
                      <tbody>
                        <tr class="border">
                          <th class="w-40 text-left border pa-2 text-sky-800">LINE:</th>
                          <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_LINE }}</td>
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
                            {{ item.raw.TEC_RFHREC_EMPNO }}
                          </td>
                        </tr>
                        <tr class="border">
                          <th class="text-left border pa-2 text-sky-800 w-30">
                            Model ที่ต้องเปลี่ยน:
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
                    <v-btn variant="flat" color="green" rounded="lg" @click="goAppr(item.raw)">
                      <v-icon icon="mdi mdi-check-bold" class="mr-2"></v-icon>
                      ยืนยันส่งอนุมัติ</v-btn>
                    <v-btn variant="flat" color="error" rounded="lg" class="ms-2">
                      <v-icon icon="mdi mdi-keyboard-return" class="mr-2"></v-icon>
                      กลับไปแก้ไข</v-btn>
                  </div>

                  <v-btn variant="flat" color="indigo" rounded="lg" @click="togglePDF(item.raw)">
                    <v-icon icon="mdi mdi-file-pdf-box" class="mr-2"></v-icon>
                    View PDF
                  </v-btn>
                </div>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
        <rfdocs :data-item="selected_data_rf" />
      </template>

      <template v-slot:footer="{ page, pageCount, prevPage, nextPage }">
        <div class="justify-center d-flex align-center pa-4">
          <v-btn :disabled="page === 1" density="comfortable" icon="mdi mdi-menu-left" variant="tonal" rounded
            @click="prevPage"></v-btn>

          <div class="mx-2 text-caption">Page {{ page }} of {{ pageCount }}</div>

          <v-btn :disabled="page >= pageCount" density="comfortable" icon="mdi mdi-menu-right" variant="tonal" rounded
            @click="nextPage"></v-btn>
        </div>
      </template>
    </v-data-iterator>
  </v-card>
</template>

<script setup lang="ts">
definePageMeta({
  layout: "custom",
});

import { ref, onMounted, defineExpose } from "vue";
import axios from "axios";
import dayjs from "dayjs";
import rfdocs from "~/components/rfdocs.vue";

const all_data_rf = ref<any>([]);
const search_rf = ref<string>("");

interface DataItem {
  OPR_HREC_LINE?: string;
  OPR_HREC_DATEREC?: string;
  OPR_HREC_STATUSMDL?: string;
  OPR_HREC_CURMDLNM?: string;
  OPR_HREC_CHNMDLNM?: string;
}
const selected_data_rf = ref<DataItem | null>(null);

const GetAllData = async () => {
  try {
    const res = await axios.get(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/alldata"
    );
    console.log(res.data);
    all_data_rf.value = res.data.rf;
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
  selected_data_rf.value = item;
  // console.log(selected_data_cp.value)
  // pdfGen.value?.createPdf()
};

onMounted(() => {
  GetAllData();
});
</script>
