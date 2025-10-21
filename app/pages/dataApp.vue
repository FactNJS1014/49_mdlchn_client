<template>
    <v-card>
        <v-data-iterator :items="all_data" :items-per-page="2" :search="search">
            <template v-slot:header>
                <v-toolbar class="px-2 bg-blue-lighten-2">
                    <div class="flex justify-between align-center w-[500px]">
                        <v-text-field v-model="search" density="comfortable" placeholder="Search"
                            prepend-inner-icon="mdi mdi-magnify" style="max-width: 300px" variant="solo" clearable
                            hide-details></v-text-field>
                        <v-text class="text-xl font-weight-bold"> Process: CP </v-text>
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
                                                    <th class="w-40 text-left border pa-2 text-sky-800">
                                                        LINE:
                                                    </th>
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
                                        <v-btn size="small" variant="tonal" class="bg-green-darken-2" rounded="lg"
                                            @click="goAppr(item.raw)">
                                            <v-icon icon="mdi mdi-check-bold" class="mr-2"></v-icon>
                                            ยืนยันส่งอนุมัติ</v-btn>
                                        <v-btn size="small" variant="tonal" class="bg-red-darken-2 ms-2" rounded="lg">
                                            <v-icon icon="mdi mdi-keyboard-return" class="mr-2"></v-icon>
                                            กลับไปแก้ไข</v-btn>
                                    </div>

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
                <cpdocs :data-item="selected_data_cp" />
            </template>

            <!-- เรียกใช้ cpdocs.vue -->

            <template v-slot:footer="{ page, pageCount, prevPage, nextPage }">
                <div class="justify-center d-flex align-center pa-4">
                    <v-btn :disabled="page === 1" density="comfortable" icon="mdi mdi-menu-left" variant="tonal" rounded
                        @click="prevPage"></v-btn>

                    <div class="mx-2 text-caption">
                        Page {{ page }} of {{ pageCount }}
                    </div>

                    <v-btn :disabled="page >= pageCount" density="comfortable" icon="mdi mdi-menu-right" variant="tonal"
                        rounded @click="nextPage"></v-btn>
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
    OPR_HREC_LINE?: string
    OPR_HREC_DATEREC?: string
    OPR_HREC_STATUSMDL?: string
    OPR_HREC_CURMDLNM?: string
    OPR_HREC_CHNMDLNM?: string
}

const selected_data_cp = ref<DataItem | null>(null)
// const pdfGen = ref<InstanceType<typeof cpdocs> | null>(null)

/**
 * TODO: สร้างฟังก์ชันรับค่าจาก api
 */

const GetAllData = async () => {
    try {
        const res = await axios.get(
            "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/alldata"
        );
        // console.log(res.data);
        all_data.value = res.data.cp;
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
    selected_data_cp.value = item
    // console.log(selected_data_cp.value)
    // pdfGen.value?.createPdf()
};


/**
 * TODO:ฟังก์ชันส่งข้อมูลอนุมัติไปยังผู้อนุมัติ
 */

const goAppr = async (data: any) => {
    // console.log(data)

    const res = await axios.post('http://172.22.64.11/49_modelchange/49_mdlchn_api/api/insert/approve', data)
    if (res.data.success === true) {
        Swal.fire({
            icon: 'success',
            title: 'ส่งอนุมัติสำเร็จ',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            location.reload()
        })
    }

}

onMounted(async () => {
    await GetAllData();
});
</script>
