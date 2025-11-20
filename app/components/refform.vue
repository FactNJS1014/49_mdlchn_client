<template>
  <v-form @submit.prevent="handleRFSubmit">
    <!-- <v-btn width="200" rounded="md" @click="clearForm" color="teal" class="mt-1">
      <template #prepend>
        <v-icon class="mdi mdi-format-clear"></v-icon>
      </template>
<h1 class="text-md">Clear Form</h1>
</v-btn> -->
    <div class="flex gap-3 align-center mt-2">
      <div class="flex gap-2 align-center">
        <h1>Employee ID :</h1>
        <span>
          <input
            type="text"
            class="w-full px-3 py-2 border border-gray-800 rounded-lg focus:outline-none"
            v-model="empno"
          />
        </span>
      </div>

      <div class="px-3 py-2 border rounded-lg">
        <h1>Work Order of Change: {{ won_chn }}</h1>
      </div>
      <div class="px-3 py-2 border rounded-lg">
        <h1>Model Name of Change : {{ model_chn }}</h1>
      </div>
    </div>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">1) Loader Input</div>
        <v-radio-group inline class="gap-4" v-model="load_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>
      <v-col cols="6" md="4" v-if="pitch_std">
        <div class="mt-3 font-semibold">Pitch Setting</div>
        <v-radio-group inline class="gap-4" v-model="pitch_rf">
          <v-radio label="10 mm." value="10 mm."></v-radio>
          <v-radio label="20 mm." value="20 mm."></v-radio>
          <v-radio label="30 mm." value="30 mm."></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">2) Stacker</div>
        <v-radio-group inline class="gap-4" v-model="stack_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">3) Traceability Input</div>
        <v-radio-group inline class="gap-4" v-model="trace_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">4) PCB Cleaning</div>
        <v-radio-group inline class="gap-4" v-model="cln_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>
      <v-col cols="6" md="4" v-if="func_std">
        <div class="mt-3 font-semibold">Function</div>
        <v-select
          v-model="func"
          :items="funcPCB"
          item-title="name"
          item-value="name"
          chips
          multiple
          clearable
          @update:model-value="func = func.filter((v) => v !== '')"
        />

        <!-- <p>{{ func }}</p> -->
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="etc_details"
          label="Etc."
        />
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">5) Printer</div>
        <v-radio-group inline class="gap-4" v-model="printer_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="printer_std_use">
        <div class="mt-3 font-semibold">5.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="printer_prg"
          :label="props.pcbno"
          :value="props.pcbno"
        />
        <!-- <v-radio-group inline class="gap-4" v-model="printer_prg">
            <v-radio :label="props.pcbno" :value="props.pcbno"></v-radio>
          </v-radio-group> -->
        <div class="mt-3 font-semibold">5.2 Metal Mask</div>
        <v-radio-group inline class="gap-4" v-model="metalmask">
          <v-radio label="Reference PCB Number" value="Reference PCB Number"></v-radio>
          <v-radio label="REF#." value="REF"></v-radio>
        </v-radio-group>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="ref_mm"
          v-if="open_ref_use"
        />
        <div class="mt-3 font-semibold">5.3 Squeegee</div>
        <v-radio-group inline class="gap-4" v-model="squee">
          <v-radio label="Good condition" value="Good condition"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">5.4 Support PCB</div>
        <v-radio-group inline class="gap-4" v-model="sup_rf">
          <v-radio label="Backup plate" value="Backup plate"></v-radio>
          <v-radio label="Backup pin" value="Backup pin"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">5.5 Solder plate number</div>
        <v-select
          v-model="solder"
          variant="outlined"
          rounded="md"
          :items="db_solder"
          item-title="SAG_SUBMATNUM"
        >
        </v-select>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">6) Glue</div>
        <v-radio-group inline class="gap-4" v-model="glue_rf">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="glue_ref_use">
        <div class="mt-3 font-semibold">6.1 Program name</div>

        <v-text-field
          variant="outlined"
          density="compact"
          v-model="glue_prg"
          :value="props.prgnm"
        />
        <!-- <v-radio-group inline class="gap-4" v-model="glue_prg">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
        <div class="mt-3 font-semibold">6.2 Glue number</div>
        <v-select
          v-model="glue_num"
          variant="outlined"
          rounded="md"
          :items="db_glue"
          item-title="SAG_SUBMATNUM"
        >
        </v-select>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">7) Solder plate inspection</div>
        <v-radio-group inline class="gap-4" v-model="solder_use">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="solder_user_std">
        <div class="mt-3 font-semibold">Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="solder_prgnm"
          :value="props.prgnm"
          class="w-auto"
        />
        <!-- <v-radio-group inline class="gap-4" v-model="solder_prgnm">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">8) Mounter (M/C #1)</div>
        <v-radio-group inline class="gap-4" v-model="mounter_ref_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="mounter_ref_use">
        <div class="mt-3 font-semibold">8.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_ref_mount1"
          :value="props.prgnm"
        />
        <!-- <v-radio-group inline class="gap-4" v-model="prg_ref_mount1">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
        <div class="mt-3 font-semibold">8.2 Nozzle setting</div>
        <v-radio-group inline class="gap-4" v-model="noz_ref_mount1">
          <v-radio label="Automatic" value="Automatic"></v-radio>
          <v-radio label="Manual" value="Manual"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">8.3 Support PCB</div>
        <v-radio-group inline class="gap-4" v-model="sup_ref_mount1">
          <v-radio label="Pin" value="Pin"></v-radio>
          <v-radio label="Magnet" value="Magnet"></v-radio>
          <v-radio label="Sponge" value="Sponge"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">9) Mounter (M/C #2)</div>
        <v-radio-group inline class="gap-4" v-model="mounter2_ref_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="mounter2_ref_use">
        <div class="mt-3 font-semibold">9.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_ref_mount2"
          :value="props.prgnm"
        />
        <!-- <v-radio-group inline class="gap-4" v-model="prg_ref_mount2">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
        <div class="mt-3 font-semibold">9.2 Nozzle setting</div>
        <v-radio-group inline class="gap-4" v-model="noz_ref_mount2">
          <v-radio label="Automatic" value="Automatic"></v-radio>
          <v-radio label="Manual" value="Manual"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">9.3 Support PCB</div>
        <v-radio-group inline class="gap-4" v-model="sup_ref_mount2">
          <v-radio label="Pin" value="Pin"></v-radio>
          <v-radio label="Magnet" value="Magnet"></v-radio>
          <v-radio label="Sponge" value="Sponge"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">10) Mounter (M/C #3)</div>
        <v-radio-group inline class="gap-4" v-model="mounter3_ref_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="mounter3_ref_use">
        <div class="mt-3 font-semibold">10.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_ref_mount3"
          :value="props.prgnm"
        />
        <!-- <v-radio-group inline class="gap-4" v-model="prg_ref_mount3">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
        <div class="mt-3 font-semibold">10.2 Nozzle setting</div>
        <v-radio-group inline class="gap-4" v-model="noz_ref_mount3">
          <v-radio label="Automatic" value="Automatic"></v-radio>
          <v-radio label="Manual" value="Manual"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">10.3 Support PCB</div>
        <v-radio-group inline class="gap-4" v-model="sup_ref_mount3">
          <v-radio label="Pin" value="Pin"></v-radio>
          <v-radio label="Magnet" value="Magnet"></v-radio>
          <v-radio label="Sponge" value="Sponge"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">11) Mounter (M/C #4)</div>
        <v-radio-group inline class="gap-4" v-model="mounter4_ref_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="mounter4_ref_use">
        <div class="mt-3 font-semibold">11.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_ref_mount4"
          :value="props.prgnm"
        />
        <!-- <v-radio-group inline class="gap-4" v-model="prg_ref_mount4">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
        <div class="mt-3 font-semibold">11.2 Nozzle setting</div>
        <v-radio-group inline class="gap-4" v-model="noz_ref_mount4">
          <v-radio label="Automatic" value="Automatic"></v-radio>
          <v-radio label="Manual" value="Manual"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">11.3 Support PCB</div>
        <v-radio-group inline class="gap-4" v-model="sup_ref_mount4">
          <v-radio label="Pin" value="Pin"></v-radio>
          <v-radio label="Magnet" value="Magnet"></v-radio>
          <v-radio label="Sponge" value="Sponge"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">12) Mounter Inspector</div>
        <v-radio-group inline class="gap-4" v-model="mounter_ref_inps">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="mounter_ref_inps_std">
        <div class="mt-3 font-semibold">12.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_ref_inspct"
          :value="props.prgnm"
        />
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">13) Reflow</div>
        <v-radio-group inline class="gap-4" v-model="reflow_rf_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="reflow_rf_use_std">
        <div class="mt-3 font-semibold">13.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_rf_reflow"
          :value="props.pcbno"
        />

        <div class="mt-3 font-semibold">13.2 Oxygen</div>
        <v-radio-group inline class="gap-4" v-model="oxygen_rf_reflow_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="oxyen_rf_use"
          v-if="oxygen_rf_std_use"
        />
        <div class="mt-3 font-semibold">13.3 PCB Supporter</div>
        <v-radio-group inline class="gap-4" v-model="sup_rf_reflow_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">13.4 Temperature profile</div>
        <v-radio-group inline class="gap-4" v-model="temp_rf_std">
          <v-radio label="Pass" value="Pass"></v-radio>
          <v-radio label="Not Pass" value="Not Pass"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">14) PCB Cooling</div>
        <v-radio-group inline class="gap-4" v-model="cooling_rf_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">15) Auto Optic Inspection</div>
        <v-radio-group inline class="gap-4" v-model="auto_rf_inps">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="auto_rf_inps_std">
        <div class="mt-3 font-semibold">Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_rf_auto"
          :value="props.prgnm"
        />
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">16) NG Stocker</div>
        <v-radio-group inline class="gap-4" v-model="ng_stock_rf_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="ng_stock_rf_std_use">
        <div class="mt-3 font-semibold">Pitch Setting</div>
        <v-radio-group inline class="gap-4" v-model="ng_stock_rf_pitch">
          <v-radio label="10 mm." value="10 mm."></v-radio>
          <v-radio label="20 mm." value="20 mm."></v-radio>
          <v-radio label="30 mm." value="30 mm."></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">17) Tracebility Input</div>
        <v-radio-group inline class="gap-4" v-model="trace_rf_inp_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">18) Unloader Input</div>
        <v-radio-group inline class="gap-4" v-model="unloader_rf_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="unloader_rf_std_use">
        <div class="mt-3 font-semibold">Pitch Setting</div>
        <v-radio-group inline class="gap-4" v-model="unloader_rf_pitch">
          <v-radio label="10 mm." value="10 mm."></v-radio>
          <v-radio label="20 mm." value="20 mm."></v-radio>
          <v-radio label="30 mm." value="30 mm."></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters class="justify-center mt-10">
      <v-btn width="200" rounded="md" type="submit">
        <template #prepend>
          <v-icon class="mdi mdi-content-save"></v-icon>
        </template>
        <h1 class="text-md">Save</h1>
      </v-btn>
    </v-row>
  </v-form>
</template>
<script setup lang="ts">
import { ref, onMounted, computed, watch } from "vue";
import axios from "axios";
import Swal from "sweetalert2";

const props = defineProps({
  id: String,
  won_chn: String,
  model_chn: String,
  empno: String,
  data_edit: Object,
  cus: String,
  prgnm: String,
  pcbno: String,
});

/**
 * TODO: สร้างตัวแปรรับค่าจาก Input Form
 */

const load_inp = ref<string>("");
const pitch_rf = ref<string>("");
const cln_inp = ref<string>("");
const func = ref<string[]>([]);
const stack_inp = ref<string>("");
const trace_inp = ref<string>("");
const etc_details = ref<string>("");
const printer_std = ref<string>("");
const printer_prg = ref<string>("");
const metalmask = ref<string>("");
const ref_mm = ref<string>("");
const squee = ref<string>("");
const sup_rf = ref<string>("");
const solder = ref<string>("");
const glue_rf = ref<string>("");
const glue_prg = ref<string>("");
const glue_num = ref<string>("");
const solder_use = ref<string>("");
const solder_prgnm = ref<string>("");
const mounter_ref_inp = ref<string>("");
const prg_ref_mount1 = ref<string>("");
const noz_ref_mount1 = ref<string>("");
const sup_ref_mount1 = ref<string>("");
const mounter2_ref_inp = ref<string>("");
const prg_ref_mount2 = ref<string>("");
const noz_ref_mount2 = ref<string>("");
const sup_ref_mount2 = ref<string>("");
const mounter3_ref_inp = ref<string>("");
const prg_ref_mount3 = ref<string>("");
const noz_ref_mount3 = ref<string>("");
const sup_ref_mount3 = ref<string>("");
const mounter4_ref_inp = ref<string>("");
const prg_ref_mount4 = ref<string>("");
const noz_ref_mount4 = ref<string>("");
const sup_ref_mount4 = ref<string>("");
const mounter_ref_inps = ref<string>("");
const prg_ref_inspct = ref<string>("");
const reflow_rf_std = ref<string>("");
const prg_rf_reflow = ref<string>("");
const oxygen_rf_reflow_std = ref<string>("");
const oxyen_rf_use = ref<string>("Value");
const sup_rf_reflow_std = ref<string>("");
const temp_rf_std = ref<string>("");
const cooling_rf_std = ref<string>("");
const auto_rf_inps = ref<string>("");
const prg_rf_auto = ref<string>("");
const ng_stock_rf_std = ref<string>("");
const ng_stock_rf_pitch = ref<string>("");
const trace_rf_inp_std = ref<string>("");
const unloader_rf_std = ref<string>("");
const unloader_rf_pitch = ref<string>("");

const db_glue = ref<string[]>([]);
const db_solder = ref<string[]>([]);
const funcPCB = ref<{ name: string }[]>([
  { name: "Air blow" },
  { name: "Sticky" },
  { name: "Lonizer" },
]);
/**
 * TODO: สร้างตัวแปรรับค่าสถานะการเลือกให้แสดงข้อมูล input
 */
const pitch_std = computed<boolean>(() => load_inp.value === "Use");
const func_std = computed<boolean>(() => cln_inp.value === "Use");
const etc_std = computed(() => func.value.includes("etc"));
const printer_std_use = computed<boolean>(() => printer_std.value === "Use");
const open_ref_use = computed<boolean>(() => metalmask.value === "REF");
const glue_ref_use = computed<boolean>(() => glue_rf.value === "Use");
const solder_user_std = computed<boolean>(() => solder_use.value === "Use");
const mounter_ref_use = computed<boolean>(() => mounter_ref_inp.value === "Use");
const mounter2_ref_use = computed<boolean>(() => mounter2_ref_inp.value === "Use");
const mounter3_ref_use = computed<boolean>(() => mounter3_ref_inp.value === "Use");
const mounter4_ref_use = computed<boolean>(() => mounter4_ref_inp.value === "Use");
const mounter_ref_inps_std = computed<boolean>(() => mounter_ref_inps.value === "Use");
const reflow_rf_use_std = computed<boolean>(() => reflow_rf_std.value === "Use");
const oxygen_rf_std_use = computed<boolean>(() => oxygen_rf_reflow_std.value === "Use");
const auto_rf_inps_std = computed<boolean>(() => auto_rf_inps.value === "Use");
const ng_stock_rf_std_use = computed<boolean>(() => ng_stock_rf_std.value === "Use");
const unloader_rf_std_use = computed<boolean>(() => unloader_rf_std.value === "Use");
const empno = computed<string>(() => props.empno || "");

const obj = props.data_edit || {};
const id_rf = ref<string>("");
id_rf.value = obj.TEC_RFHREC_ID || "";

/**
 * TODO: สร้างฟังก์ชันส่งข้อมูลไปยัง api
 */
const handleRFSubmit = async () => {
  try {
    const payload = {
      load_inp: load_inp.value,
      pitch_rf: pitch_rf.value,
      cln_inp: cln_inp.value,
      func: func.value,
      stack_inp: stack_inp.value,
      trace_inp: trace_inp.value,
      etc_details: etc_details.value,
      printer_std: printer_std.value,
      printer_prg: printer_prg.value,
      metalmask: metalmask.value,
      ref_mm: ref_mm.value,
      squee: squee.value,
      sup_rf: sup_rf.value,
      solder: solder.value,
      glue_rf: glue_rf.value,
      glue_prg: glue_prg.value,
      glue_num: glue_num.value,
      solder_use: solder_use.value,
      solder_prgnm: solder_prgnm.value,
      mounter_ref_inp: mounter_ref_inp.value,
      prg_ref_mount1: prg_ref_mount1.value,
      noz_ref_mount1: noz_ref_mount1.value,
      sup_ref_mount1: sup_ref_mount1.value,
      mounter2_ref_inp: mounter2_ref_inp.value,
      prg_ref_mount2: prg_ref_mount2.value,
      noz_ref_mount2: noz_ref_mount2.value,
      sup_ref_mount2: sup_ref_mount2.value,
      mounter3_ref_inp: mounter3_ref_inp.value,
      prg_ref_mount3: prg_ref_mount3.value,
      noz_ref_mount3: noz_ref_mount3.value,
      sup_ref_mount3: sup_ref_mount3.value,
      mounter4_ref_inp: mounter4_ref_inp.value,
      prg_ref_mount4: prg_ref_mount4.value,
      noz_ref_mount4: noz_ref_mount4.value,
      sup_ref_mount4: sup_ref_mount4.value,
      mounter_ref_inps: mounter_ref_inps.value,
      prg_ref_inspct: prg_ref_inspct.value,
      reflow_rf_std: reflow_rf_std.value,
      prg_rf_reflow: prg_rf_reflow.value,
      oxygen_rf_reflow_std: oxygen_rf_reflow_std.value,
      oxyen_rf_use: oxyen_rf_use.value,
      sup_rf_reflow_std: sup_rf_reflow_std.value,
      temp_rf_std: temp_rf_std.value,
      cooling_rf_std: cooling_rf_std.value,
      auto_rf_inps: auto_rf_inps.value,
      prg_rf_auto: prg_rf_auto.value,
      ng_stock_rf_std: ng_stock_rf_std.value,
      ng_stock_rf_pitch: ng_stock_rf_pitch.value,
      trace_rf_inp_std: trace_rf_inp_std.value,
      unloader_rf_std: unloader_rf_std.value,
      unloader_rf_pitch: unloader_rf_pitch.value,
      empno: empno.value,
      id: props.id,
    };

    if (id_rf.value === "") {
      const res = await axios.post(
        "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/rfinsert",
        payload
      );
      if (res.data.status === true) {
        Swal.fire({
          icon: "success",
          title: "บันทึกข้อมูลสำเร็จ",
          showConfirmButton: false,
          timer: 1500,
        });
      }
    } else {
      const res = await axios.put(
        "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/rfupdate/" + id_rf.value,
        payload
      );
      if (res.data.status === true) {
        Swal.fire({
          icon: "success",
          title: "อัปเดตข้อมูลสำเร็จ",
          showConfirmButton: false,
          timer: 1500,
        }).then(() => {
          localStorage.removeItem("data");
          location.reload();
          //   // ✅ ล้างค่าทั้งหมด
          //   load_inp.value = "";
          //   pitch_rf.value = "";
          //   cln_inp.value = "";
          //   func.value = "";
          //   stack_inp.value = "";
          //   trace_inp.value = "";
          //   etc_details.value = "";
          //   printer_std.value = "";
          //   printer_prg.value = "";
          //   metalmask.value = "";
          //   ref_mm.value = "";
          //   squee.value = "";
          //   sup_rf.value = "";
          //   solder.value = "";
          //   glue_rf.value = "";
          //   glue_prg.value = "";
          //   glue_num.value = "";
          //   solder_use.value = "";
          //   solder_prgnm.value = "";
          //   mounter_ref_inp.value = "";
          //   prg_ref_mount1.value = "";
          //   noz_ref_mount1.value = "";
          //   sup_ref_mount1.value = "";
          //   mounter2_ref_inp.value = "";
          //   prg_ref_mount2.value = "";
          //   noz_ref_mount2.value = "";
          //   sup_ref_mount2.value = "";
          //   mounter3_ref_inp.value = "";
          //   prg_ref_mount3.value = "";
          //   noz_ref_mount3.value = "";
          //   sup_ref_mount3.value = "";
          //   mounter4_ref_inp.value = "";
          //   prg_ref_mount4.value = "";
          //   noz_ref_mount4.value = "";
          //   sup_ref_mount4.value = "";
          //   mounter_ref_inps.value = "";
          //   prg_ref_inspct.value = "";
          //   reflow_rf_std.value = "";
          //   prg_rf_reflow.value = "";
          //   oxygen_rf_reflow_std.value = "";
          //   oxyen_rf_use.value = "";
          //   sup_rf_reflow_std.value = "";
          //   temp_rf_std.value = "";
          //   cooling_rf_std.value = "";
          //   auto_rf_inps.value = "";
          //   prg_rf_auto.value = "";
          //   ng_stock_rf_std.value = "";
          //   ng_stock_rf_pitch.value = "";
          //   trace_rf_inp_std.value = "";
          //   unloader_rf_std.value = "";
          //   unloader_rf_pitch.value = "";
          //   id_rf.value = ""; // ถ้ามีตัวนี้ใช้เช็ค mode insert/update
        });
      }
    }
  } catch (error) {
    console.log(error);
  }
};

const clearForm = () => {
  // ✅ ล้างค่าทั้งหมด
  load_inp.value = "";
  pitch_rf.value = "";
  cln_inp.value = "";
  func.value = [];
  stack_inp.value = "";
  trace_inp.value = "";
  etc_details.value = "";
  printer_std.value = "";
  printer_prg.value = "";
  metalmask.value = "";
  ref_mm.value = "";
  squee.value = "";
  sup_rf.value = "";
  solder.value = "";
  glue_rf.value = "";
  glue_prg.value = "";
  glue_num.value = "";
  solder_use.value = "";
  solder_prgnm.value = "";
  mounter_ref_inp.value = "";
  prg_ref_mount1.value = "";
  noz_ref_mount1.value = "";
  sup_ref_mount1.value = "";
  mounter2_ref_inp.value = "";
  prg_ref_mount2.value = "";
  noz_ref_mount2.value = "";
  sup_ref_mount2.value = "";
  mounter3_ref_inp.value = "";
  prg_ref_mount3.value = "";
  noz_ref_mount3.value = "";
  sup_ref_mount3.value = "";
  mounter4_ref_inp.value = "";
  prg_ref_mount4.value = "";
  noz_ref_mount4.value = "";
  sup_ref_mount4.value = "";
  mounter_ref_inps.value = "";
  prg_ref_inspct.value = "";
  reflow_rf_std.value = "";
  prg_rf_reflow.value = "";
  oxygen_rf_reflow_std.value = "";
  oxyen_rf_use.value = "";
  sup_rf_reflow_std.value = "";
  temp_rf_std.value = "";
  cooling_rf_std.value = "";
  auto_rf_inps.value = "";
  prg_rf_auto.value = "";
  ng_stock_rf_std.value = "";
  ng_stock_rf_pitch.value = "";
  trace_rf_inp_std.value = "";
  unloader_rf_std.value = "";
  unloader_rf_pitch.value = "";
  id_rf.value = ""; // ถ้ามีตัวนี้ใช้เช็ค mode insert/update
};

const data_rf_edit = (obj: any) => {
  load_inp.value = obj.TEC_RFHREC_LOADINP || "";
  pitch_rf.value = obj.TEC_RFHREC_LOADINPPITCH || "";
  stack_inp.value = obj.TEC_RFHREC_STACK || "";
  trace_inp.value = obj.TEC_RFHREC_TRACEINP || "";
  cln_inp.value = obj.TEC_RFHREC_PCBCLEAN || "";
  func.value = obj.TEC_RFHREC_PCBCLNFUNC || "";
  printer_std.value = obj.TEC_RFHREC_PRINT || "";
  printer_prg.value = obj.TEC_RFHREC_PRINTPROG || "";
  metalmask.value = obj.TEC_RFHREC_PRINTMM || "";
  ref_mm.value = obj.TEC_RFHREC_PRINTMMREF || "";
  squee.value = obj.TEC_RFHREC_PRINTSQUE || "";
  sup_rf.value = obj.TEC_RFHREC_PRINTSUPT || "";
  solder.value = obj.TEC_RFHREC_PRINTSOLDER || "";
  glue_rf.value = obj.TEC_RFHREC_GLUE || "";
  glue_prg.value = obj.TEC_RFHREC_GLUEPROG || "";
  glue_num.value = obj.TEC_RFHREC_GLUENUM || "";
  solder_use.value = obj.TEC_RFHREC_SOLDERINSP || "";
  solder_prgnm.value = obj.TEC_RFHREC_SOLDERPROG || "";
  mounter_ref_inp.value = obj.TEC_RFHREC_MNTF || "";
  prg_ref_mount1.value = obj.TEC_RFHREC_MNTFPROG || "";
  noz_ref_mount1.value = obj.TEC_RFHREC_MNTFNOZ || "";
  sup_ref_mount1.value = obj.TEC_RFHREC_MNTFSUPT || "";
  mounter2_ref_inp.value = obj.TEC_RFHREC_MNTSN || "";
  prg_ref_mount2.value = obj.TEC_RFHREC_MNTSNPROG || "";
  noz_ref_mount2.value = obj.TEC_RFHREC_MNTSNNOZ || "";
  sup_ref_mount2.value = obj.TEC_RFHREC_MNTSNSUPT || "";
  mounter3_ref_inp.value = obj.TEC_RFHREC_MNTTR || "";
  prg_ref_mount3.value = obj.TEC_RFHREC_MNTTRPROG || "";
  noz_ref_mount3.value = obj.TEC_RFHREC_MNTTRNOZ || "";
  sup_ref_mount3.value = obj.TEC_RFHREC_MNTTRSUPT || "";
  mounter4_ref_inp.value = obj.TEC_RFHREC_MNTFO || "";
  prg_ref_mount4.value = obj.TEC_RFHREC_MNTFOPROG || "";
  noz_ref_mount4.value = obj.TEC_RFHREC_MNTFONOZ || "";
  sup_ref_mount4.value = obj.TEC_RFHREC_MNTFOSUPT || "";
  mounter_ref_inps.value = obj.TEC_RFHREC_MNTINSP || "";
  prg_ref_inspct.value = obj.TEC_RFHREC_MNTINSPPROG || "";
  reflow_rf_std.value = obj.TEC_RFHREC_REFLOW || "";
  prg_rf_reflow.value = obj.TEC_RFHREC_REFLPROG || "";
  oxygen_rf_reflow_std.value = obj.TEC_RFHREC_REFLOXYGEN || "";
  oxyen_rf_use.value = obj.TEC_RFHREC_REFLOO || "";
  sup_rf_reflow_std.value = obj.TEC_RFHREC_REFLPCBSUPT || "";
  temp_rf_std.value = obj.TEC_RFHREC_REFLTEMP || "";
  cooling_rf_std.value = obj.TEC_RFHREC_PCBCOOL || "";
  auto_rf_inps.value = obj.TEC_RFHREC_AUTO || "";
  prg_rf_auto.value = obj.TEC_RFHREC_AUTOPROG || "";
  ng_stock_rf_std.value = obj.TEC_RFHREC_NGSTCK || "";
  ng_stock_rf_pitch.value = obj.TEC_RFHREC_NGSTCKPITCH || "";
  trace_rf_inp_std.value = obj.TEC_RFHREC_TRACE || "";
  unloader_rf_std.value = obj.TEC_RFHREC_UNLOADER || "";
  unloader_rf_pitch.value = obj.TEC_RFHREC_UNLOADERPITCH || "";
  etc_details.value = obj.TEC_RFHREC_PCBLNETC || "";
};

watch(load_inp, (newVal) => {
  if (newVal === "Not Use") {
    pitch_rf.value = "";
  }
});

watch(cln_inp, (newVal) => {
  if (newVal === "Not Use") {
    func.value = [];
    etc_details.value = "";
  }
});

watch(printer_std, (newVal) => {
  if (newVal === "Not User") {
    printer_prg.value = "";
    metalmask.value = "";
    ref_mm.value = "";
    squee.value = "";
    sup_rf.value = "";
    solder.value = "";
  }
});

watch(glue_rf, (newVal) => {
  if (newVal === "Not User") {
    glue_prg.value = "";
    glue_num.value = "";
  }
});

watch(solder_use, (newVal) => {
  if (newVal === "Not Use") {
    solder_prgnm.value = "";
  }
});

watch(mounter_ref_inp, (newVal) => {
  if (newVal === "Not Use") {
    prg_ref_mount1.value = "";
    noz_ref_mount1.value = "";
    sup_ref_mount1.value = "";
  }
});
watch(mounter2_ref_inp, (newVal) => {
  if (newVal === "Not Use") {
    prg_ref_mount2.value = "";
    noz_ref_mount2.value = "";
    sup_ref_mount2.value = "";
  }
});
watch(mounter3_ref_inp, (newVal) => {
  if (newVal === "Not Use") {
    prg_ref_mount3.value = "";
    noz_ref_mount3.value = "";
    sup_ref_mount3.value = "";
  }
});

watch(mounter4_ref_inp, (newVal) => {
  if (newVal === "Not Use") {
    prg_ref_mount4.value = "";
    noz_ref_mount4.value = "";
    sup_ref_mount4.value = "";
  }
});

watch(mounter_ref_inps, (newVal) => {
  if (newVal === "Not Use") {
    prg_ref_inspct.value = "";
  }
});

watch(reflow_rf_std, (newVal) => {
  if (newVal === "Not Use") {
    prg_rf_reflow.value = "";
    oxygen_rf_reflow_std.value = "";
    oxyen_rf_use.value = "";
    sup_rf_reflow_std.value = "";
    temp_rf_std.value = "";
  }
});

watch(auto_rf_inps, (newVal) => {
  if (newVal === "Not Use") {
    prg_rf_auto.value = "";
  }
});

watch(ng_stock_rf_std, (newVal) => {
  if (newVal === "Not Use") {
    ng_stock_rf_pitch.value = "";
  }
});

watch(unloader_rf_std, (newVal) => {
  if (newVal === "Not Use") {
    unloader_rf_pitch.value = "";
  }
});

const fetchDB = async () => {
  const res = await axios.get(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/settings"
  );
  db_glue.value = res.data.glue;
  db_solder.value = res.data.solder;
  console.log(res.data.glue);
  console.log(res.data.solder);
};
onMounted(() => {
  data_rf_edit(obj);
  fetchDB();
});
</script>
