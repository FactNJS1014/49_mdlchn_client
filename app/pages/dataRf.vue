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
                    <strong class="mb-2 text-h6">Document No. :{{ item.raw.OPR_HREC_ISSUENO
                      }}</strong>
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
                    <v-btn size="small" variant="tonal" class="bg-green-darken-2" rounded="lg">
                      <v-icon icon="mdi mdi-check-bold" class="mr-2"></v-icon>
                      อนุมัติ</v-btn>
                    <v-btn size="small" variant="tonal" class="bg-red-darken-2 ms-2" rounded="lg">
                      <v-icon icon="mdi mdi-keyboard-return" class="mr-2"></v-icon>
                      ส่งกลับแก้ไข</v-btn>
                  </div>

                  <!-- ส่งข้อมูลไป component -->
                  <v-btn size="small" variant="tonal" class="bg-blue-darken-2 ms-2" rounded="lg"
                    @click="togglePDF(item.raw)">
                    <v-icon icon="mdi mdi-file-pdf-box" class="mr-2"></v-icon>
                    View PDF
                  </v-btn>
                </div>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
        <div v-if="selectedPDF && selectedPDFUrl" class="mt-4 pa-2">
          <h3 class="mb-2 text-lg font-bold">
            Preview: Document No. {{ selectedPDF.OPR_HREC_ISSUENO }}
          </h3>
          <iframe :src="selectedPDFUrl" class="w-full h-[700px] border rounded" title="PDF Preview"></iframe>
        </div>
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
  layout: 'custom'
})

import { ref, onMounted, defineExpose } from "vue";
import axios from "axios";
import dayjs from "dayjs";

const all_data_rf = ref<any>([]);
const search_rf = ref<string>("");

const selectedPDF = ref<any | null>(null)
const selectedPDFUrl = ref<string | null>(null)

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

const togglePDF = async (item: any) => {
  selectedPDF.value = selectedPDF.value?.OPR_HREC_ID === item.OPR_HREC_ID ? null : item
  if (!selectedPDF.value) {
    selectedPDFUrl.value = null
    return
  }

  // ✅ import jsPDF & html2canvas แค่ client-side
  if (process.client) {
    const jsPDF = (await import('jspdf')).default
    const html2canvas = (await import('html2canvas')).default

    // สร้าง element ชั่วคราวเพื่อ render PDF
    const element = document.createElement('div')
    element.innerHTML = `
   <div class="p-2">
        <div class="w-full border border-black">
            <div class="flex items-center justify-center col-span-3 py-6 text-lg font-bold text-center">
                MODEL CHANGE RECORD SMT PROCESS : ${item.OPR_HREC_PROCS}
            </div>
        </div>
        <div class="w-full px-2 py-4 mt-2 border border-black">
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class="flex flex-col">
                    <div><strong>Line:</strong> ${item.OPR_HREC_LINE}</div>
                </div>
                <div class="flex flex-col">
                    <div><strong>Date:</strong> ${item.OPR_HREC_DATEREC}</div>
                </div>
                <div class="flex flex-col">
                    <div><strong>Document No.:</strong> ${item.OPR_HREC_ISSUENO}</div>
                </div>
            </div>

            <!-- Status Checkbox -->
            <div class="flex flex-col mt-4">
                <div class="flex flex-wrap gap-4">
                    <strong>Status:</strong>
                    <div class="flex items-center ms-2">
                        <input type="checkbox" class="w-5 h-5 mt-2 mr-2" ${item.OPR_HREC_STATUSMDL === 'Urgent'
        ? 'checked' : ''} />
                        <span class="mb-2">Urgent</span>
                    </div>
                    <div class="flex items-center ms-2">
                        <input type="checkbox" class="w-5 h-5 mt-2 mr-2" ${item.OPR_HREC_STATUSMDL === 'Normal'
        ? 'checked' : ''} />
                        <span class="mb-2">Normal</span>
                    </div>
                    <div class="flex items-center ms-2">
                        <input type="checkbox" class="w-5 h-5 mt-2 mr-2" ${item.OPR_HREC_STATUSMDL === 'New Line'
        ? 'checked' : ''} />
                        <span class="mb-2">New Line</span>
                    </div>
                    <div class="flex items-center ms-2">
                        <input type="checkbox" class="w-5 h-5 mt-2 mr-2" ${item.OPR_HREC_STATUSMDL === 'New model'
        ? 'checked' : ''} />
                        <span class="mb-2">New model</span>
                    </div>
                    <div class="flex items-center ms-2">
                        <input type="checkbox" class="w-5 h-5 mt-2 mr-2" ${item.OPR_HREC_STATUSMDL === 'Over Plan'
        ? 'checked' : ''} />
                        <span class="mb-2">Over Plan</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="flex flex-col">
                    <div><strong>Current Model Code:</strong> ${item.OPR_HREC_CURMDLNM}</div>
                </div>
                <div class="flex flex-col">
                    <div><strong>Change Model Code:</strong> ${item.OPR_HREC_CHNMDLNM}</div>
                </div>

            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="flex flex-col">
                    <div class="flex gap-3">
                        <div><strong>WO#:</strong> ${item.OPR_HREC_WON_CURRENT}</div>
                        <div><strong>Lot Size:</strong> ${item.OPR_HREC_LOTS} pcs.</div>
                        <div class="flex items-center"><input type="checkbox" class="w-5 h-5 mt-2 mr-2"
                                ${item.OPR_HREC_PROCS_RF === 'RF1' ? 'checked' : ''} />
                            <span class="mb-2">RF1</span>
                        </div>
                        <div class="flex items-center"><input type="checkbox" class="w-5 h-5 mt-2 mr-2"
                                ${item.OPR_HREC_PROCS_RF === 'RF2' ? 'checked' : ''} />
                            <span class="mb-2">RF2</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="flex gap-3">
                        <div><strong>WO#:</strong> ${item.OPR_HREC_WON_CHANGE}</div>
                        <div><strong>Lot Size:</strong> ${item.OPR_HREC_LOTS_CHN} pcs.</div>
                        <div class="flex items-center"><input type="checkbox" class="w-5 h-5 mt-2 mr-2"
                                ${item.OPR_HREC_PROCS_RF_CHN === 'RF1' ? 'checked' : ''} />
                            <span class="mb-2">RF1</span>
                        </div>
                        <div class="flex items-center"><input type="checkbox" class="w-5 h-5 mt-2 mr-2"
                                ${item.OPR_HREC_PROCS_RF_CHN === 'RF2' ? 'checked' : ''} />
                            <span class="mb-2">RF2</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="flex flex-col">
                    <div class="flex gap-3">
                        <div><strong>ECN Control:</strong></div>
                        <div class="flex items-center"><input type="checkbox" class="w-5 h-5 mt-2 mr-2"
                                ${item.OPR_HREC_CONTECN === 'No Have' ? 'checked' : ''} />
                            <span class="mb-2">No Have</span>
                        </div>
                        <div class="flex items-center"><input type="checkbox" class="w-5 h-5 mt-2 mr-2"
                                ${item.OPR_HREC_CONTECN === 'Have' ? 'checked' : ''} />
                            <span class="mb-2">Have</span>
                        </div>
                       
                    </div>

                </div>
                <div class="flex flex-col">
                  <div class="flex items-center">
                      <span class="mb-2 text-md">ECN Number: ${item.OPR_HREC_HAVECONTECN_NO}</span>
                      <span class="mb-2 text-md ms-3">ECN REV: ${item.OPR_HREC_HAVECONTECN_REV}</span>
                  </div>               
                </div>

            </div>
           
        </div>

    </div>
     
    `
    document.body.appendChild(element)

    const canvas = await html2canvas(element, { scale: 2, useCORS: true })
    const imgData = canvas.toDataURL('image/png')
    const pdf = new jsPDF('p', 'mm', 'a4')
    const pdfWidth = pdf.internal.pageSize.getWidth()
    const pdfHeight = (canvas.height * pdfWidth) / canvas.width
    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight)

    selectedPDFUrl.value = pdf.output('bloburl')
    document.body.removeChild(element)
  }
}

onMounted(() => {
  GetAllData()
})

</script>
