<template>
  <v-card>
    <v-tabs
      v-model="tab"
      class="text-grey-darken-1 bg-blue-lighten-5"
      color="light-blue-darken-1"
    >
      <v-tab value="one" class="font-weight-medium">OPERATOR FORM</v-tab>
      <v-badge inline location="top right" color="red" :content="get_rec.length">
        <v-tab value="two" class="font-weight-medium"> ตรวจสอบข้อมูลบันทึก </v-tab>
      </v-badge>
    </v-tabs>

    <v-card-text>
      <v-virtual-scroll :items="[1]" height="550" item-height="auto">
        <template #default>
          <v-tabs-window v-model="tab">
            <v-tabs-window-item value="one">
              <div class="px-2 py-3 rounded-sm bg-sky-500">
                <div class="flex justify-between">
                  <div>
                    <span class="font-semibold">FORM FOR OPERATOR</span>
                  </div>
                </div>
              </div>

              <div class="flex align-center">
                <h1
                  class="font-semibold text-lg bg-light-blue-accent-1 pa-1 rounded-l-md"
                >
                  เอกสาร Process:
                </h1>
                <v-switch
                  v-model="prs"
                  :label="`Process: ${prs}`"
                  false-value="CP"
                  true-value="RF"
                  hide-details
                  color="blue"
                  class="ms-3"
                ></v-switch>
              </div>

              <!-- ✅ เพิ่ม v-virtual-scroll -->

              <v-form @submit.prevent="handleSubmitForm">
                <div class="flex gap-2 align-center">
                  <h1>Employee ID :</h1>
                  <span>
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-800 rounded-lg focus:outline-none"
                      v-model="empno"
                      required
                    />
                  </span>
                </div>
                <v-row no-gutters class="gap-3">
                  <v-col cols="4">
                    <div class="mt-3 font-semibold">Line No. :</div>
                    <v-select
                      v-model="line"
                      variant="outlined"
                      rounded="md"
                      :items="line_list"
                      item-title="LINE_NAME"
                      :rules="LineRules"
                    >
                    </v-select>
                  </v-col>
                  <v-col cols="4">
                    <div class="mt-3 font-semibold">Issue No. :</div>
                    <v-text-field
                      variant="outlined"
                      rounded="md"
                      v-model="issue_no"
                      :rules="IssueNoRules"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="3" md="3">
                    <div class="mt-3 font-semibold">Issue Date :</div>
                    <input
                      type="date"
                      class="w-full px-3 py-4 text-base placeholder-gray-400 transition-colors bg-white border border-gray-300 rounded focus:outline-none"
                      v-model="date_rec"
                      required
                      readonly
                    />
                  </v-col>
                </v-row>
                <v-row no-gutters>
                  <div class="mt-3 font-semibold">Status :</div>
                  <span class="mt-1">
                    <v-radio-group
                      inline
                      class="gap-4"
                      v-model="status"
                      :rules="StatusRules"
                    >
                      <v-radio label="Urgent" value="Urgent" color="info"></v-radio>
                      <v-radio label="Normal" value="Normal" color="info"></v-radio>
                      <v-radio label="New line" value="New line" color="info"></v-radio>
                      <v-radio label="New model" value="New model" color="info"></v-radio>
                      <v-radio label="Over Plan" value="Over Plan" color="info"></v-radio>
                    </v-radio-group>
                  </span>
                </v-row>
                <v-row no-gutters class="gap-3">
                  <v-col cols="4" md="5">
                    <div class="mt-3 font-semibold">WO# (เดิม):</div>
                    <v-autocomplete
                      variant="outlined"
                      rounded="md"
                      :items="won_list"
                      item-title="WON"
                      item-value="WON"
                      v-model="won_cur"
                      :rules="WorkOrderRules"
                      @update:modelValue="SelectWonCur"
                    ></v-autocomplete>
                  </v-col>
                  <v-col cols="6" md="5">
                    <div class="mt-3 font-semibold">Current Model Code :</div>
                    <v-text-field
                      variant="outlined"
                      rounded="md"
                      v-model="cur_modelname"
                      :rules="CurrentModelRules"
                    >
                    </v-text-field>
                    <!-- <v-autocomplete variant="outlined" rounded="md" :items="model_name_list" item-title="MDLNM" item-value="MDLNM" v-model="cur_modelname" :rules="CurrentModelRules"></v-autocomplete> -->
                  </v-col>
                  <v-col cols="6" md="5">
                    <div class="mt-3 font-semibold">Lot Size เดิม:</div>
                    <v-number-input
                      variant="outlined"
                      rounded="md"
                      v-model="lots"
                      :min="0"
                      :rules="LotsRules"
                    />
                  </v-col>
                  <v-col cols="6" md="3" v-if="!prs_check">
                    <div class="mt-3 font-semibold">Process: (CP) เดิม</div>
                    <v-radio-group
                      inline
                      class="gap-4"
                      v-model="procs_cp"
                      :rules="ProcessRules"
                    >
                      <v-radio label="CP" value="CP" color="info"></v-radio>
                      <v-radio label="RF" value="RF" color="info"></v-radio>
                    </v-radio-group>
                  </v-col>
                  <v-col cols="6" md="3" v-if="prs_check">
                    <div class="mt-3 font-semibold">Process: (RF) เดิม</div>
                    <v-radio-group
                      inline
                      class="gap-4"
                      v-model="procs_rf"
                      :rules="ProcessRules"
                    >
                      <v-radio label="CP" value="CP" color="info"></v-radio>
                      <v-radio label="RF1" value="RF1" color="info"></v-radio>
                      <v-radio label="RF2" value="RF2" color="info"></v-radio>
                      <v-radio label="RF" value="RF" color="info"></v-radio>
                    </v-radio-group>
                  </v-col>
                </v-row>
                <v-row no-gutters class="gap-3">
                  <v-col cols="4" md="5">
                    <div class="mt-3 font-semibold">WO# (เปลี่ยน):</div>
                    <v-autocomplete
                      variant="outlined"
                      rounded="md"
                      :items="won_list"
                      item-title="WON"
                      item-value="WON"
                      v-model="won_chn"
                      :rules="WorkOrderRules"
                      @update:modelValue="SelectWonChn"
                    ></v-autocomplete>
                  </v-col>
                  <v-col cols="6" md="5">
                    <div class="mt-3 font-semibold">Change Model Code :</div>
                    <v-text-field
                      variant="outlined"
                      rounded="md"
                      v-model="chn_modelname"
                      :rules="ChangeModelRules"
                    />
                    <!-- <v-autocomplete variant="outlined" rounded="md" :items="model_name_list" item-title="MDLNM" item-value="MDLNM" v-model="chn_modelname" :rules="ChangeModelRules" s></v-autocomplete> -->
                  </v-col>
                  <v-col cols="6" md="5">
                    <div class="mt-3 font-semibold">Lot Size เปลี่ยน:</div>
                    <v-number-input
                      variant="outlined"
                      rounded="md"
                      v-model="lots_chn"
                      :min="0"
                      :rules="LotsRules"
                    />
                  </v-col>
                  <v-col cols="6" md="3" v-if="!prs_check">
                    <div class="mt-3 font-semibold">Process: (CP) เปลี่ยน</div>
                    <v-radio-group
                      inline
                      class="gap-4"
                      v-model="procs_cp_chn"
                      :rules="ProcessRules"
                    >
                      <v-radio label="CP" value="CP" color="info"></v-radio>
                      <v-radio label="RF" value="RF" color="info"></v-radio>
                    </v-radio-group>
                  </v-col>
                  <v-col cols="6" md="3" v-if="prs_check">
                    <div class="mt-3 font-semibold">Process: (RF) เปลี่ยน</div>
                    <v-radio-group
                      inline
                      class="gap-4"
                      v-model="procs_rf_chn"
                      :rules="ProcessRules"
                    >
                      <v-radio label="CP" value="CP" color="info"></v-radio>
                      <v-radio label="RF1" value="RF1" color="info"></v-radio>
                      <v-radio label="RF2" value="RF2" color="info"></v-radio>
                      <v-radio label="RF" value="RF" color="info"></v-radio>
                    </v-radio-group>
                  </v-col>
                </v-row>
                <v-row no-gutters class="gap-6"> </v-row>
                <v-row no-gutters class="gap-3">
                  <v-col cols="4" md="5">
                    <div class="mt-3 font-semibold">ECN Control :</div>
                    <v-radio-group
                      inline
                      class="gap-4"
                      v-model="ecn"
                      :rules="ecnContolRules"
                    >
                      <v-radio label="No Have" value="No Have" color="info"></v-radio>
                      <v-radio label="Have" value="Have" color="info"></v-radio>
                    </v-radio-group>
                  </v-col>
                  <v-col cols="4" md="3">
                    <div class="mt-3 font-semibold" v-if="have_ecn">ECN Number :</div>
                    <v-text-field
                      v-if="have_ecn"
                      variant="outlined"
                      density="compact"
                      v-model="ecn_num"
                    />
                  </v-col>
                  <v-col cols="4" md="3">
                    <div class="mt-3 font-semibold" v-if="have_ecn">REV :</div>
                    <v-text-field
                      v-if="have_ecn"
                      variant="outlined"
                      density="compact"
                      v-model="ecn_rev"
                    />
                  </v-col>
                </v-row>
                <v-row no-gutters class="gap-3">
                  <v-col cols="6" md="5">
                    <div class="mt-3 font-semibold">Program Name :</div>
                    <v-text-field
                      variant="outlined"
                      density="compact"
                      v-model="prog_name"
                      :rules="programNameRules"
                    />
                  </v-col>
                  <v-col cols="6" md="5">
                    <div class="mt-3 font-semibold">PCB No.:</div>
                    <v-text-field
                      variant="outlined"
                      density="compact"
                      v-model="prog_rev"
                      :rules="revInputRules"
                    />
                  </v-col>
                </v-row>
                <v-row no-gutters class="gap-3">
                  <v-col cols="6" md="5">
                    <div class="mt-3 font-semibold">Customer Name :</div>
                    <v-select
                      v-model="customer"
                      variant="outlined"
                      rounded="md"
                      :items="customer_list"
                      item-title="BGCD"
                      :rules="customerRules"
                    ></v-select>
                  </v-col>
                </v-row>
                <v-row no-gutters class="justify-center mt-10">
                  <v-btn color="green" width="200" rounded="md" type="submit">
                    <template #prepend>
                      <v-icon icon="mdi mdi-content-save-check"></v-icon>
                    </template>
                    <h1 class="text-md">Save</h1>
                  </v-btn>
                </v-row>
              </v-form>
            </v-tabs-window-item>

            <v-tabs-window-item value="two">
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
                    <v-icon icon="mdi mdi-magnify"></v-icon>
                  </template>
                </v-text-field>
              </v-card-title>
              <v-divider></v-divider>
              <v-data-table-virtual
                :headers="headers"
                :items="get_rec"
                v-model:search="search"
                :filter-keys="['OPR_HREC_WON_CHANGE']"
                density="compact"
                height="550"
                fixed-header
              >
                <template #item="{ item }">
                  <tr class="text-no-wrap">
                    <td>
                      <div class="flex justify-between">
                        <div class="pa-2">
                          <v-btn
                            color="blue"
                            rounded="xl"
                            @click="OpenDetails(item)"
                            icon="mdi mdi-text-box"
                            density="comfortable"
                          >
                          </v-btn>
                          <v-btn
                            color="red"
                            rounded="xl"
                            @click="DeleteData(item.OPR_HREC_ID)"
                            class="ms-3"
                            icon="mdi mdi-delete"
                            density="comfortable"
                          >
                          </v-btn>
                        </div>
                      </div>
                    </td>
                    <td style="min-width: 125px">{{ item.OPR_HREC_DATEREC }}</td>
                    <td style="min-width: 200px">{{ item.OPR_HREC_ISSUENO }}</td>
                    <td style="min-width: 80px">{{ item.OPR_HREC_PROCS }}</td>

                    <td style="min-width: 150px">{{ item.OPR_HREC_WON_CHANGE }}</td>
                    <td style="min-width: 150px">{{ item.OPR_HREC_CHNMDLNM }}</td>
                  </tr>
                </template>
              </v-data-table-virtual>
            </v-tabs-window-item>
          </v-tabs-window>
        </template>
      </v-virtual-scroll>
    </v-card-text>
    <v-dialog v-model="dialog" width="auto">
      <v-card min-width="800" prepend-icon="fa fa-book" :items="details">
        <template #title>
          <h1>{{ details.OPR_HREC_ID }}</h1>
        </template>
        <div class="flex">
          <div class="flex gap-3 align-center">
            <div class="w-5 h-5 bg-red-200 ms-4 rounded-2xl"></div>
            <span class="">ของเดิม</span>
          </div>
          <div class="flex gap-3 align-center">
            <div class="w-5 h-5 bg-green-200 ms-4 rounded-2xl"></div>
            <span class="">ของใหม่</span>
          </div>
        </div>

        <table class="w-full mt-3 border border-gray-600">
          <tbody>
            <tr>
              <th class="px-2 py-1 text-left border">เลขเอกสาร:</th>
              <td class="px-2 py-1 border">{{ details.OPR_HREC_ISSUENO }}</td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">Process:</th>
              <td class="px-2 py-1 border">{{ details.OPR_HREC_PROCS }}</td>
            </tr>
            <tr v-if="details.OPR_HREC_PROCS === 'RF'">
              <th class="px-2 py-1 text-left border">Process RF ของเดิม:</th>
              <td class="px-2 py-1 border">{{ details.OPR_HREC_PROCS_RF }}</td>
            </tr>
            <tr v-if="details.OPR_HREC_PROCS === 'RF'">
              <th class="px-2 py-1 text-left border">Process RF ของใหม่:</th>
              <td class="px-2 py-1 border">{{ details.OPR_HREC_PROCS_RF_CHN }}</td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">สถานะการเปลี่ยน Model:</th>
              <td class="px-2 py-1 border">{{ details.OPR_HREC_STATUSMDL }}</td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">WO# เดิม:</th>
              <td class="px-2 py-1 bg-red-200 border">
                {{ details.OPR_HREC_WON_CURRENT }}
              </td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">Model เดิม:</th>
              <td class="px-2 py-1 bg-red-200 border">{{ details.OPR_HREC_CURMDLNM }}</td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">WO# ใหม่:</th>
              <td class="px-2 py-1 bg-green-200 border">
                {{ details.OPR_HREC_WON_CHANGE }}
              </td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">Model ใหม่:</th>
              <td class="px-2 py-1 bg-green-200 border">
                {{ details.OPR_HREC_CHNMDLNM }}
              </td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">Lot Size เดิม:</th>
              <td class="px-2 py-1 bg-red-200 border">{{ details.OPR_HREC_LOTS }}</td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">Lot Size ใหม่:</th>
              <td class="px-2 py-1 bg-green-200 border">
                {{ details.OPR_HREC_LOTS_CHN }}
              </td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">ECN Control (Have or No Have):</th>
              <td class="px-2 py-1 border">{{ details.OPR_HREC_CONTECN }}</td>
            </tr>
            <tr v-if="details.OPR_HREC_CONTECN === 'Have'">
              <th class="px-2 py-1 text-left border">ECN Number:</th>
              <td class="px-2 py-1 border">{{ details.OPR_HREC_HAVECONTECN_NO }}</td>
            </tr>
            <tr v-if="details.OPR_HREC_CONTECN === 'Have'">
              <th class="px-2 py-1 text-left border">ECN Revision:</th>
              <td class="px-2 py-1 border">{{ details.OPR_HREC_HAVECONTECN_REV }}</td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">Program Name:</th>
              <td class="px-2 py-1 border">{{ details.OPR_HREC_PRGMNM }}</td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">Revision:</th>
              <td class="px-2 py-1 border">{{ details.OPR_HREC_PRGMREV }}</td>
            </tr>
            <tr>
              <th class="px-2 py-1 text-left border">Customer:</th>
              <td class="px-2 py-1 border">{{ details.OPR_HREC_CUS }}</td>
            </tr>
          </tbody>
        </table>

        <div class="flex justify-start mt-3 align-center ms-3">
          <div class="flex justify-between gap-3">
            <v-btn rounded @click="goToEdit(details)" color="warning">
              <template #prepend>
                <v-icon icon="mdi mdi-pencil-box"></v-icon>
              </template>
              <h1>Edit (แก้ไข)</h1>
            </v-btn>

            <v-btn rounded @click="Approve(details.OPR_HREC_ID)" color="success">
              <template #prepend>
                <v-icon icon="mdi mdi-check-underline-circle"></v-icon>
              </template>
              <h1>Submit (ยืนยัน)</h1>
            </v-btn>
          </div>
        </div>

        <template #actions>
          <v-btn class="ms-auto" text="Close" @click="dialog = false"></v-btn>
        </template>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script setup lang="ts">
import { ref, onMounted, computed, reactive } from "vue";
import axios from "axios";
import dayjs from "dayjs";
import Swal from "sweetalert2";

definePageMeta({
  layout: "custom",
});

/**
 * TODO: สร้างตัวแปรรับค่าจาก Input
 */

const prs = ref<string>("CP");
const procs_rf = ref<string>("");
const ecn = ref<string>("No Have");
const ecn_num = ref<string>("");
const ecn_rev = ref<string>("");
const date_rec = ref<string>("");
const line = ref<string>("");
const issue_no = ref<string>("");
const status = ref<string>("");
const lots = ref<number>(0);
const prog_name = ref<string>("");
const prog_rev = ref<string>("");
const empno = ref<string>("");
const cur_modelname = ref<string>("");
const chn_modelname = ref<string>("");
const won_cur = ref<string>("");
const won_chn = ref<string>("");
const search = ref<string>("");
const lots_chn = ref<number>(0);
const procs_rf_chn = ref<string>("");
const dialog = ref<boolean>(false);
const customer = ref<string>("");
const id = ref<string>("");
const procs_cp = ref<string>("");
const procs_cp_chn = ref<string>("");

const tab = ref<string>("one");

const issue_num = ref<string>("");

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

  //   // location.reload();
  //   if (res.data.redirect) {
  //     // redirect browser ไปหน้า frontend
  //     window.location.href = res.data.redirect;
  //     return;
  //   }

  user.value = res.data;
  console.log("user session:", user.value);
  empno.value = user.value.empno;
};

/**
 * TODO: เก็บค่าตัวแปรแสดงหัวข้อตาราง (Headers)
 */
const headers = ref<any>([
  { title: "Actions", align: "left" },
  { title: "วันที่บันทึก", key: "OPR_HREC_DATEREC", align: "left" },
  { title: "เลขเอกสาร", key: "OPR_HREC_ISSUENO" },
  { title: "Process", key: "OPR_HREC_PROCS" },

  { title: "Work Order ใหม่", key: "OPR_HREC_WON_CHANGE" },
  { title: "Model ใหม่", key: "OPR_HREC_CHNMDLNM" },
]);

/**
 * TODO: สร้างตัวแปรรับค่าจาก api
 *
 */
const won_list = ref<any>([]);
const model_name_list = ref<any>([]);
const line_list = ref<any>([]);
const check_model = ref<any>([]);
const get_rec = ref<any>([]);
const details = ref<any>([]);
const customer_list = ref<any>([]);

/**
 * TODO: สร้างสถานะการเลือกแสดงข้อมูลบันทึก
 */
const prs_check = computed<boolean>(() => prs.value === "RF");
const have_ecn = computed<boolean>(() => ecn.value === "Have");

/**
 * ? แสดงวันที่ Input เป็นวันที่ปัจจุบัน
 */
date_rec.value = dayjs().format("YYYY-MM-DD");

/**
 * TODO: นำข้อมูลเข้าไปยัง api
 * !ทดสอบรับค่าจาก form
 */
const handleSubmitForm = async () => {
  if (prs.value === "CP") {
    try {
      const payload = {
        prs: prs.value,
        ecn: ecn.value,
        ecn_num: ecn_num.value,
        ecn_rev: ecn_rev.value,
        date_rec: date_rec.value,
        line: line.value,
        issue_no: issue_no.value,
        status: status.value,
        lots: lots.value,
        prog_name: prog_name.value,
        prog_rev: prog_name.value,
        empno: empno.value,
        cur_modelname: cur_modelname.value,
        chn_modelname: chn_modelname.value,
        won_cur: won_cur.value,
        won_chn: won_chn.value,
        lots_chn: lots_chn.value,
        customer: customer.value,
        procs_cp: procs_cp.value,
        procs_cp_chn: procs_cp_chn.value,
      };
      console.log(payload);

      if (id.value === "") {
        const insert = await axios.post(
          "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/oprform",
          payload
        );

        if (insert.data.status === true) {
          Swal.fire({
            title: "บันทึกเสร็จสมบูรณ์",
            icon: "success",
            timer: 1500,
            showConfirmButton: false,
          }).then(() => {
            tab.value = "two";
            GetRecordForm();
          });
        }
      } else {
        const update = await axios.put(
          "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/oprform/update/" +
            id.value,
          payload
        );
        // console.log(update.data)
        if (update.data.status === true) {
          Swal.fire({
            title: "อัปเดตเสร็จสมบูรณ์",
            icon: "success",
            timer: 1500,
            showConfirmButton: false,
          }).then(() => {
            tab.value = "two";
            GetRecordForm();
          });
        }
      }
    } catch (error) {
      Swal.fire({
        title: "Error ในการบันทึกข้อมูล",
        text: "โปรดติดต่อกลับมาหา IT (System)",
        icon: "error",
        timer: 1500,
      });
    }
  } else {
    try {
      const payload = {
        prs: prs.value,
        ecn: ecn.value,
        procs_rf: procs_rf.value,
        have_ecn: ecn.value,
        ecn_num: ecn_num.value,
        ecn_rev: ecn_rev.value,
        date_rec: date_rec.value,
        line: line.value,
        issue_no: issue_no.value,
        status: status.value,
        lots: lots.value,
        prog_name: prog_name.value,
        prog_rev: prog_name.value,
        empno: empno.value,
        cur_modelname: cur_modelname.value,
        chn_modelname: chn_modelname.value,
        won_cur: won_cur.value,
        won_chn: won_chn.value,
        lots_chn: lots_chn.value,
        procs_rf_chn: procs_rf_chn.value,
        customer: customer.value,
      };
      // console.log(payload)
      if (id.value === "") {
        const insert_rf = await axios.post(
          "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/oprform/rf",
          payload
        );
        if (insert_rf.data.status === true) {
          Swal.fire({
            title: "บันทึกเสร็จสมบูรณ์",
            icon: "success",
            timer: 1500,
            showConfirmButton: false,
          }).then(() => {
            tab.value = "two";
            GetRecordForm();
          });
        }
      } else {
        const update_rf = await axios.put(
          "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/oprform/rf/update/" +
            id.value,
          payload
        );
        if (update_rf.data.status === true) {
          Swal.fire({
            title: "อัปเดตเสร็จสมบูรณ์",
            icon: "success",
            timer: 1500,
            showConfirmButton: false,
          }).then(() => {
            tab.value = "two";
            GetRecordForm();
          });
        }
      }
    } catch (error) {
      Swal.fire({
        title: "Error ในการบันทึกข้อมูล",
        text: "โปรดติดต่อกลับมาหา IT (System)",
        icon: "error",
        timer: 1500,
      });
    }
  }
};

const OpenDetails = async (obj: any) => {
  // console.log(obj)
  dialog.value = true;
  details.value = obj;
};

const goToEdit = (obj: any) => {
  tab.value = "one";

  // console.log(obj)
  id.value = obj.OPR_HREC_ID;
  prs.value = obj.OPR_HREC_PROCS;
  empno.value = obj.OPR_HREC_EMPNO;
  line.value = obj.OPR_HREC_LINE;
  issue_no.value = obj.OPR_HREC_ISSUENO;
  date_rec.value = obj.OPR_HREC_DATEREC;
  status.value = obj.OPR_HREC_STATUSMDL;
  won_cur.value = obj.OPR_HREC_WON_CURRENT;
  cur_modelname.value = obj.OPR_HREC_CURMDLNM;
  lots.value = parseInt(obj.OPR_HREC_LOTS);
  won_chn.value = obj.OPR_HREC_WON_CHANGE;
  chn_modelname.value = obj.OPR_HREC_CHNMDLNM;
  lots_chn.value = parseInt(obj.OPR_HREC_LOTS_CHN);
  procs_rf.value = obj.OPR_HREC_PROCS_RF;
  procs_rf_chn.value = obj.OPR_HREC_PROCS_RF_CHN;
  ecn.value = obj.OPR_HREC_CONTECN;
  ecn_num.value = obj.OPR_HREC_HAVECONTECN_NO;
  ecn_rev.value = obj.OPR_HREC_HAVECONTECN_REV;
  prog_name.value = obj.OPR_HREC_PRGMNM;
  prog_rev.value = obj.OPR_HREC_PRGMREV;
  customer.value = obj.OPR_HREC_CUS;
  procs_cp.value = obj.OPR_HREC_PROCSCP;
  procs_cp_chn.value = obj.OPR_HREC_PROCSCP_CHN;
  dialog.value = false;
};

const Approve = async (id: string) => {
  // console.log('Submit: ', id)
  try {
    await axios.put("http://172.22.64.11/49_modelchange/49_mdlchn_api/api/submit/" + id);
    dialog.value = false;
    GetRecordForm();
  } catch (error) {
    console.log(error);
  }
};

const DeleteData = async (id: string) => {
  // console.log('Delete ID: ', id)

  try {
    const button = await Swal.fire({
      icon: "warning",
      title: `ลบข้อมูล`,
      text: "คุณต้องการลบข้อมูลนี้หรือไม่",
      showCancelButton: true,
      showConfirmButton: true,
    });

    if (button.isConfirmed) {
      const res = await axios.delete(
        "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/data/delete/" + id
      );

      if (res.data.status === true) {
        Swal.fire({
          title: "อัปเดตเสร็จสมบูรณ์",
          icon: "success",
          timer: 1500,
          showConfirmButton: false,
        }).then(() => {
          tab.value = "two";
          GetRecordForm();
        });
      }
    }
  } catch (error) {
    console.log(error);
  }
};

/**
 * TODO: ฟังก์ชันรับค่าจาก api
 */

const SelectWonCur = async (value: string) => {
  const won_cur_check = value.trim();
  try {
    const res = await axios.get(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/checkmodel",
      {
        params: { value: won_cur_check },
      }
    );
    check_model.value = res.data;
    // console.log('Select Won and Model: ', check_model.value)
    res.data.map((mo: any) => {
      cur_modelname.value = mo.MDLCD;
    });
  } catch (error) {
    console.log(error);
  }
};
const SelectWonChn = async (value: string) => {
  const won_chn_check = value.trim();
  try {
    const res = await axios.get(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/checkmodel",
      {
        params: { value: won_chn_check },
      }
    );
    check_model.value = res.data;
    // console.log('Select Won and Model: ', check_model.value)
    res.data.map((mo: any) => {
      chn_modelname.value = mo.MDLCD;
    });
  } catch (error) {
    console.log(error);
  }
};

const fetchApiWon = async () => {
  try {
    const res = await axios.get(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/won"
    );
    won_list.value = res.data;
  } catch (error) {
    console.log(error);
  }
};

const fetchApiModelName = async () => {
  try {
    const res = await axios.get(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/modelname"
    );
    model_name_list.value = res.data;
  } catch (error) {
    console.log(error);
  }
};

const fetchApiLine = async () => {
  try {
    const res = await axios.get(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/line"
    );
    line_list.value = res.data;
    // console.log(line_list.value)
  } catch (error) {
    console.log(error);
  }
};

const fetchApiCustomer = async () => {
  try {
    const res = await axios.get(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/cus"
    );
    customer_list.value = res.data;
    // console.log(customer_list.value);
  } catch (error) {
    console.log(error);
  }
};

const fetchApiIssueNo = async () => {
  try {
    const res = await axios.get(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/issueno"
    );
    issue_num.value = res.data;
    issue_no.value = (issue_num.value.split("-").pop() ?? "").slice(-3);
    // console.log(customer_list.value);
  } catch (error) {
    console.log(error);
  }
};

const GetRecordForm = async () => {
  try {
    const res = await axios.get(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/record/opr"
    );
    get_rec.value = res.data;
    // console.log(get_rec.value)
  } catch (error) {
    console.log(error);
  }
};

/**
 * TODO: ฟังก์ชันตรวจสอบการกรอกข้อมูล (Validation)
 */
const LineRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please select at least one line.";
  },
];

const IssueNoRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please input text fields.";
  },
];

const StatusRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please select status changing.";
  },
];

const CurrentModelRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please current model name.";
  },
];

const ChangeModelRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please change model name.";
  },
];

const WorkOrderRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please select work order.";
  },
];

const LotsRules: ((value: number) => true | string)[] = [
  (value) => {
    if (value && value >= 0) return true;
    return "Please input lot size.";
  },
];

const ProcessRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please choose process RF1 or RF2.";
  },
];

const ecnContolRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please select ecn control.";
  },
];

const programNameRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please input program name.";
  },
];

const revInputRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please input revision.";
  },
];

const customerRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please input revision.";
  },
];

/**
 * TODO: เรียกใช้งานฟังก์ชัน api
 */
onMounted(async () => {
  await fetchApiWon();
  await fetchApiModelName();
  await fetchApiLine();
  await GetRecordForm();
  await sessionUser();
  await fetchApiCustomer();
  await fetchApiIssueNo();
});
</script>
