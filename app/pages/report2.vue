<template>
  <v-container>
    <v-data-table
      :headers="headers"
      :items="tableItems"
      item-key="OPR_HREC_ID"
      class="elevation-1"
    >
      <template #item.timeline="{ item }">
        <v-btn @click="openTimeline(item)" class="rounded-xl" color="teal darken-3">
          <v-icon icon="mdi mdi-timeline-check" size="24"></v-icon>
        </v-btn>
      </template>
      <template #item.view="{ item }">
        <v-btn @click="openViewPdf(item)" class="rounded-xl" color="light-blue darken-3">
          <v-icon icon="mdi mdi-database-eye" size="24"></v-icon>
        </v-btn>
      </template>
    </v-data-table>
    <Rfreport :rfItem="report_rf" />
    <v-dialog v-model="dialog" max-width="500">
      <v-card>
        <v-card-title>
          <div>
            <p class="text-xl font-bold">Time line อนุมัติ Model Change</p>
            <p>หมายเอกสาร: {{ selected?.OPR_HREC_ISSUENO.split("-").pop().slice(-3) }}</p>
          </div>
        </v-card-title>
        <v-card-text>
          <v-timeline align="start" side="end">
            <v-timeline-item
              v-for="level in 3"
              :key="level"
              :dot-color="selected?.levels[level].empapp != 0 ? 'green' : 'red'"
              size="small"
            >
              <div class="d-flex">
                <strong class="me-4">ผู้อนุมัติลำดับที่ {{ level }}</strong>
                <div>
                  <strong>
                    {{
                      selected?.levels[level]?.empapp != 0
                        ? selected?.levels[level]?.empname
                        : "XXXXXXX"
                    }}
                  </strong>
                  <div class="text-caption">
                    {{ selected?.levels[level]?.empapp != 0 ? "Completed" : "Pending" }}
                  </div>
                </div>
              </div>
            </v-timeline-item>
          </v-timeline>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="dialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from "axios";
import dayjs from "dayjs";
import Rfreport from "~/components/rfreport.vue";
definePageMeta({
  layout: "custom",
});

const groups = ref<Record<string, any>>({});
const employees = ref<string[]>([]);
const report_rf = ref<any>(null);

const headers = ref([
  { title: "ID", key: "OPR_HREC_ID" },
  { title: "Issue No", key: "OPR_HREC_ISSUENO" },
  { title: "Date Rec", key: "OPR_HREC_DATEREC" },
  { title: "Line", key: "OPR_HREC_LINE" },
  { title: "Process", key: "OPR_HREC_PROCS" },
  { title: "WON Change", key: "OPR_HREC_WON_CHANGE" },
  { title: "Model Change", key: "OPR_HREC_CHNMDLNM" },
  { title: "", key: "timeline" }, // ปุ่มกด
  { title: "", key: "view" }, // ปุ่มกด
]);

const fetchReportRF = async () => {
  const res = await axios.get(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/reports"
  );

  const rows = res.data.rep_rf;

  rows.forEach((row: any) => {
    const id = row.OPR_HREC_ID;
    const level = row.APP_REC_LEVEL;

    if (!groups.value[id]) {
      groups.value[id] = {
        OPR_HREC_ID: id,
        levels: {},
        ...row,
        raw: [],
      };
    }

    groups.value[id].levels[level] = {
      level: level,
      empapp: row.APP_REC_EMPAPP,
      empname: findUserName(row.APP_REC_EMPAPP),
      data: row,
    };
    groups.value[id].raw.push(row);

    console.log(groups);
  });
};
const dialog = ref(false);
const selected = ref<any>(null);

const openTimeline = (item: any) => {
  selected.value = item;
  dialog.value = true;
};

const GetUsersWeb = async () => {
  const res = await axios.get(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/users"
  );
  // console.log(res.data)
  employees.value = res.data.ALL;
};

const findUserName = (empId: string | number) => {
  const emp = employees.value.find((e) => e.MUSR_ID == empId);

  return emp ? emp.MUSR_NAME : "ไม่พบชื่อ";
};

const openViewPdf = (data: any) => {
  report_rf.value = data;
};

onMounted(async () => {
  await GetUsersWeb();
  await fetchReportRF();
});
// Items for DataTable
const tableItems = computed(() => Object.values(groups.value));
</script>
