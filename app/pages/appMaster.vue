<template>
  <v-card class="pa-4">
    <v-card-title>สร้างสายอนุมัติ 3 ลำดับ</v-card-title>
    <v-card-text>
      <v-form ref="formRef" @submit.prevent="onSubmit">
        <v-row>
          <v-col cols="12" sm="6">
            <v-select v-model="level1" :items="employees" item-title="MUSR_NAME" item-value="MUSR_ID"
              label="ลำดับที่ 1 (เลือกหลายคน)" multiple chips clearable />
          </v-col>

          <v-col cols="12" sm="6">
            <v-select v-model="level2" :items="employees" item-title="MUSR_NAME" item-value="MUSR_ID"
              label="ลำดับที่ 2 (เลือกหลายคน)" multiple chips clearable />
          </v-col>

          <v-col cols="12" class="mt-4">
            <v-btn color="primary" type="submit">บันทึก</v-btn>
          </v-col>
        </v-row>
      </v-form>
    </v-card-text>
  </v-card>
  <v-card class="mt-4 pa-4">
    <v-data-table :items="approveUsers" :headers="headers" class="mt-4">
      <template #item.actions="{ item }">
        <v-btn icon color="red" @click="removeMaster(item.MASTER_ID)" size="small" rounded="lg">
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </template>
    </v-data-table>
  </v-card>
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
const employees = ref<string[]>([]);
const approveUsers = ref<string[]>([]);

const headers = [
  { title: "ลำดับ", value: "MASTER_SEQ" },
  { title: "รหัสพนักงาน", value: "MASTER_EMPID" },
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

onMounted(async () => {
  await GetUsersWeb();
  await GetApproveUsers();
  await mapApproveUsersToNames();
});
</script>
