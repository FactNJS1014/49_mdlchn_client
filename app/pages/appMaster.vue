<template>
  <v-card class="pa-4">
    <v-card-title>สร้างสายอนุมัติ 3 ลำดับ</v-card-title>
    <v-card-text>
      <v-form ref="formRef" @submit.prevent="onSubmit">
        <v-row>
          <v-col cols="12" sm="6">
            <div class="mt-3 font-semibold text-xl bg-cyan-lighten-3 pa-1">
              ลำดับที่ 1: AM Sub Leader
            </div>
            <v-select v-model="level1" :items="employees_AM" item-title="MUSR_NAME" item-value="MUSR_ID"
              variant="outlined" label="ลำดับที่ 1 (เลือกหลายคน)" multiple chips clearable />
          </v-col>

          <v-col cols="12" sm="6">
            <div class="mt-3 font-semibold text-xl bg-cyan-lighten-1 pa-1">
              ลำดับที่ 2: AM Leader
            </div>
            <v-select v-model="level2" :items="employees_AM" item-title="MUSR_NAME" item-value="MUSR_ID"
              variant="outlined" label="ลำดับที่ 2 (เลือกหลายคน)" multiple chips clearable />
          </v-col>
          <v-col cols="12" sm="6">
            <div class="mt-3 font-semibold text-xl bg-teal-accent-3 pa-1">
              ลำดับที่ 3: QC
            </div>
            <v-select v-model="level3" :items="employees_QC" item-title="MUSR_NAME" item-value="MUSR_ID"
              variant="outlined" label="ลำดับที่ 3 (เลือกหลายคน)" multiple chips clearable />
          </v-col>

          <v-col cols="12" class="mt-4">
            <div class="flex justify-center items-center">
              <v-btn color="primary" type="submit" rounded="lg" width="300px"
                prepend-icon="mdi mdi-content-save-settings">บันทึก</v-btn>
            </div>
          </v-col>
        </v-row>
      </v-form>
    </v-card-text>
  </v-card>
  <v-card class="mt-4 pa-4">
    <v-data-table :items="approveUsers" :headers="headers" class="mt-4">
      <template #item.actions="{ item }">
        <v-btn icon color="warning" @click="editMaster(item)" size="small" rounded="lg">
          <v-icon>mdi-account-edit</v-icon>
        </v-btn>
      </template>
    </v-data-table>
  </v-card>
  <v-dialog v-model="editDialog" width="600">
    <v-card>
      <v-card-title class="text-h6">
        แก้ไขการอนุมัติในลำดับที่ {{ editForm.level }}
      </v-card-title>

      <v-card-text>
        <v-select v-model="editForm.empnos" :items="getEmployeesByLevel(editForm.level)" item-title="MUSR_NAME"
          item-value="MUSR_ID" label="เลือกพนักงาน" multiple chips clearable variant="outlined"></v-select>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn variant="text" @click="editDialog = false">ยกเลิก</v-btn>
        <v-btn color="primary" @click="saveMasterEdit">บันทึก</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup lang="ts">
definePageMeta({
  layout: "custom",
});

import { ref, onMounted } from "vue";
import axios from "axios";
import Swal from "sweetalert2";

const level1 = ref<string[]>([]);
const level2 = ref<string[]>([]);
const level3 = ref<string[]>([]);
const employees_AM = ref<string[]>([]);
const employees_QC = ref<string[]>([]);
const employees = ref<string[]>([]);
const approveUsers = ref<string[]>([]);
const editDialog = ref(false);
const editForm = ref({
  level: 0,
  empnos: [] as string[],
});

const headers = [
  { title: "ลำดับ", value: "MASTER_SEQ" },
  { title: "ชื่อพนักงาน", value: "MASTER_NAME" },
  { title: "Actions", value: "actions", sortable: false },
];

/**
 * TODO: function insert to api
 */

const onSubmit = async () => {
  const payload = {
    levels: [
      { level: 1, empnos: level1.value },
      { level: 2, empnos: level2.value },
      { level: 3, empnos: level3.value },
    ],
  };

  const res = await axios.post(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/insert/master",
    payload
  );
  console.log(res.data);
  if (res.data.success === true) {
    Swal.fire({
      icon: "success",
      title: "บันทึกสำเร็จ",
      showConfirmButton: false,
      timer: 1500,
      timerProgressBar: true,
    }).then(() => {
      location.reload();
    });
  }
};

/**
 * TODO: function Get api is users
 */

const GetUsersWeb = async () => {
  const res = await axios.get(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/users"
  );
  // console.log(res.data)
  employees_AM.value = res.data.AM;
  employees_QC.value = res.data.QC;
  employees.value = res.data.ALL;
};

const GetApproveUsers = async () => {
  const res = await axios.get(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/approve/users"
  );
  console.log(res.data);
  approveUsers.value = res.data;
};

// ฟังก์ชัน map EMPID ไปหา MUSR_NAME
const mapApproveUsersToNames = () => {
  approveUsers.value = approveUsers.value.map((item) => {
    if (!item.MASTER_EMPID) return item;

    // แยก EMPID เป็น array
    const empIds = item.MASTER_EMPID.split(",");
    // หา MUSR_NAME ใน employees
    const names = empIds.map((id) => {
      const emp = employees.value.find((e) => e.MUSR_ID === id.trim());
      return emp ? emp.MUSR_NAME : id;
    });
    // รวมเป็น string
    console.log(names);
    return {
      ...item,
      MASTER_NAME: names.join(", "),
    };
  });
};
const getEmployeesByLevel = (level: number) => {
  if (level == 1 || level == 2) return employees_AM.value;
  if (level == 3) return employees_QC.value;
  return [];
};

const editMaster = (item: any) => {
  editForm.value.level = item.MASTER_SEQ;
  editForm.value.empnos = item.MASTER_EMPID ? item.MASTER_EMPID.split(",") : [];
  editDialog.value = true;
};

const saveMasterEdit = async () => {
  const payload = {
    levels: [
      {
        level: editForm.value.level,
        empnos: editForm.value.empnos,
      },
    ],
  };

  const res = await axios.put(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/update/master",
    payload
  );
  if (res.data.success === true) {
    editDialog.value = false;
    Swal.fire({
      icon: "success",
      title: "แก้ไขสำเร็จ",
      showConfirmButton: false,
      timer: 1500,
      timerProgressBar: true,
    }).then(async () => {
      // โหลดข้อมูลใหม่และ map เป็นชื่อ
      await GetApproveUsers();
      await mapApproveUsersToNames();
    });
  }
};

onMounted(async () => {
  await GetUsersWeb();
  await GetApproveUsers();
  await mapApproveUsersToNames();
});
</script>
