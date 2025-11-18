<template>
  <v-card>
    <v-tabs v-model="tab" align-tabs="center" color="deep-purple-accent-4">
      <v-tab value="1">FORM</v-tab>
      <v-tab value="2">DATA SUBMAT</v-tab>
    </v-tabs>

    <v-tabs-window v-model="tab">
      <v-tabs-window-item value="1">
        <v-card-text>
          <v-virtual-scroll :items="[1]" height="620" item-height="auto">
            <div class="px-2 py-3 rounded-sm bg-sky-500">
              <div class="flex justify-between">
                <div>
                  <span class="font-semibold"
                    >FORM FOR SETTINGS DATA SOLDER PASTE AND GLUE</span
                  >
                </div>
              </div>
            </div>
            <v-form @submit.prevent="SubmitMasterSettings" class="mt-3">
              <v-row no-gutters class="gap-3 flex justify-center ma-10">
                <v-col cols="6">
                  <div class="mr-1 text-lg font-semibold">Category:</div>
                  <v-select
                    label="Select"
                    :items="['Solder Paste', 'Solder Wire', 'Glue']"
                    variant="outlined"
                    v-model="category"
                    :rules="categoryRules"
                  ></v-select>
                </v-col>
                <v-col cols="6">
                  <div class="mr-1 text-lg font-semibold">Maker:</div>
                  <v-text-field
                    label="Maker"
                    variant="outlined"
                    v-model="maker"
                  ></v-text-field>
                </v-col>
                <v-col cols="6">
                  <div class="mr-1 text-lg font-semibold">Sub Mat Number:</div>
                  <v-text-field
                    label="Maker"
                    variant="outlined"
                    v-model="submatnum"
                    :rules="submatnumRules"
                  ></v-text-field>
                </v-col>
                <v-col cols="6">
                  <div class="mr-1 text-lg font-semibold">Customers:</div>
                  <v-select
                    v-model="customers"
                    :items="customer_list"
                    item-title="BGCD"
                    item-value="BGCD"
                    variant="outlined"
                    label="เลือกลูกค้า"
                    multiple
                    chips
                    clearable
                  />
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
          </v-virtual-scroll>
        </v-card-text>
      </v-tabs-window-item>
      <v-tabs-window-item value="2">
        <div class="pa-3">
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
            :items="data_set"
            v-model:search="search"
            :filter-keys="['SAG_CATGROY']"
            density="compact"
            height="550"
            fixed-header
          >
            <template #item="{ item }">
              <tr class="text-no-wrap">
                <!-- <td>
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
                    </td> -->
                <td style="min-width: 125px">{{ item.SAG_CATEGROY }}</td>
                <td style="min-width: 200px">{{ item.SAG_MAKER }}</td>
                <td style="min-width: 80px">{{ item.SAG_SUBMATNUM }}</td>
                <td style="min-width: 150px">{{ item.SAG_CUS }}</td>
                <td style="min-width: 150px">
                  <v-chip
                    :color="item.SAG_STD == 1 ? 'green' : 'red'"
                    :text="item.SAG_STD == 1 ? 'Use' : 'No Use'"
                    class="text-uppercase"
                    size="small"
                    label
                  ></v-chip>
                </td>
              </tr>
            </template>
          </v-data-table-virtual>
        </div>
      </v-tabs-window-item>
    </v-tabs-window>
  </v-card>
</template>
<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from "axios";
import Swal from "sweetalert2";

definePageMeta({
  layout: "custom",
});
const tab = ref<number>(1);

const category = ref<string>("");
const categoryRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please select at least one Category.";
  },
];
const maker = ref<string>("1");
const submatnum = ref<string>("");
const submatnumRules: ((value: string) => true | string)[] = [
  (value) => {
    if (value && value.length > 0) return true;
    return "Please select at least one Category.";
  },
];
const customers = ref<string[]>([]);

const customer_list = ref<string[]>([]);
const data_set = ref<string[]>([]);

const fetchCustomers = async () => {
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

const SubmitMasterSettings = async () => {
  const customers_value = customers.value
    .map((c) => c.trim()) // ✅ ตัดช่องว่างซ้าย-ขวาแต่ละตัว
    .join(",");
  const payload = {
    category: category.value,
    maker: maker.value,
    submatnum: submatnum.value,
    cus: customers_value,
  };

  const res = await axios.post(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/insert/settings",
    payload
  );

  if (res.data.std === true) {
    Swal.fire({
      icon: "success",
      title: "Insert Master Successfully",
      showConfirmButton: false,
      timer: 1500,
    });
  }

  console.log(payload);
};

const fetchSAG = async () => {
  const res = await axios.get(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/settings"
  );
  data_set.value = res.data.get_db;
  console.log(res.data);
};
const headers = ref<any>([
  { title: "ชื่อประเภท", key: "SAG_CATEGROY" },
  { title: "Maker", key: "SAG_MAKER" },
  { title: "Submat Number", key: "SAG_SUBMATNUM" },
  { title: "Customers", key: "SAG_CUS" },
  { title: "Status", key: "SAG_STD" },
]);

onMounted(() => {
  fetchCustomers();
  fetchSAG();
});
</script>
