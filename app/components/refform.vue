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
        />
        <!-- <v-radio-group inline class="gap-4" v-model="printer_prg">
            <v-radio :label="props.pcbno" :value="props.pcbno"></v-radio>
          </v-radio-group> -->
        <div class="mt-3 font-semibold">5.2 Metal Mask</div>
        <v-radio-group inline class="gap-4" v-model="metalmask">
          <v-radio
            label="Reference PCB Number"
            value="Reference PCB Number"
          ></v-radio>
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
      <div v-if="reflow_rf_use_std">
        <v-col cols="12" md="20">
          <div class="mt-3 font-semibold">13.1 Program name</div>
          <v-text-field
            variant="outlined"
            density="compact"
            v-model="prg_rf_reflow"
            :label="props.prgnm"
            :value="props.prgnm"
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
          <div class="flex justify-between gap-3">
            <div class="mt-2">
              <div>TOP Side</div>
              <div class="mt-3">CH-1</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_top_ch1"
              />
              <div class="mt-2">CH-2</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_top_ch2"
              />
              <div class="mt-2">CH-3</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_top_ch3"
              />
              <div class="mt-2">CH-4</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_top_ch4"
              />
              <div class="mt-2">CH-5</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_top_ch5"
              />
              <div class="mt-2">CH-6</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_top_ch6"
              />
              <div class="mt-2">CH-7</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_top_ch7"
              />
              <div class="mt-2">CH-8</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_top_ch8"
              />
              <div class="mt-2">CH-9</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_top_ch9"
              />
              <div class="mt-2">CH-10</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_top_ch10"
              />
            </div>
            <div class="mt-2">
              <div>BOTTOM Side</div>
              <div class="mt-3">CH-1</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_btm_ch1"
                :class="diffColorch1"
              />
              <div class="mt-2">CH-2</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_btm_ch2"
                :class="diffColorch2"
              />
              <div class="mt-2">CH-3</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_btm_ch3"
                :class="diffColorch3"
              />
              <div class="mt-2">CH-4</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_btm_ch4"
                :class="diffColorch4"
              />
              <div class="mt-2">CH-5</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_btm_ch5"
                :class="diffColorch5"
              />
              <div class="mt-2">CH-6</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_btm_ch6"
                :class="diffColorch6"
              />
              <div class="mt-2">CH-7</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_btm_ch7"
                :class="diffColorch7"
              />
              <div class="mt-2">CH-8</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_btm_ch8"
                :class="diffColorch8"
              />
              <div class="mt-2">CH-9</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_btm_ch9"
                :class="diffColorch9"
              />
              <div class="mt-2">CH-10</div>
              <v-number-input
                variant="outlined"
                density="compact"
                v-model="temp_rf_btm_ch10"
                :class="diffColorch10"
              />
            </div>
          </div>
        </v-col>
      </div>
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
const printer_prg = ref<string>(props.pcbno || "");
const metalmask = ref<string>("");
const ref_mm = ref<string>("");
const squee = ref<string>("");
const sup_rf = ref<string>("");
const solder = ref<string>("");
const glue_rf = ref<string>("");
const glue_prg = ref<string>(props.prgnm || "");
const glue_num = ref<string>("");
const solder_use = ref<string>("");
const solder_prgnm = ref<string>(props.prgnm || "");
const mounter_ref_inp = ref<string>("");
const prg_ref_mount1 = ref<string>(props.prgnm || "");
const noz_ref_mount1 = ref<string>("");
const sup_ref_mount1 = ref<string>("");
const mounter2_ref_inp = ref<string>("");
const prg_ref_mount2 = ref<string>(props.prgnm || "");
const noz_ref_mount2 = ref<string>("");
const sup_ref_mount2 = ref<string>("");
const mounter3_ref_inp = ref<string>("");
const prg_ref_mount3 = ref<string>(props.prgnm || "");
const noz_ref_mount3 = ref<string>("");
const sup_ref_mount3 = ref<string>("");
const mounter4_ref_inp = ref<string>("");
const prg_ref_mount4 = ref<string>(props.prgnm || "");
const noz_ref_mount4 = ref<string>("");
const sup_ref_mount4 = ref<string>("");
const mounter_ref_inps = ref<string>("");
const prg_ref_inspct = ref<string>(props.prgnm || "");
const reflow_rf_std = ref<string>("");
const prg_rf_reflow = ref<string>(props.prgnm || "");
const oxygen_rf_reflow_std = ref<string>("");
const oxyen_rf_use = ref<string>("Value");
const sup_rf_reflow_std = ref<string>("");
const cooling_rf_std = ref<string>("");
const auto_rf_inps = ref<string>("");
const prg_rf_auto = ref<string>(props.prgnm || "");
const ng_stock_rf_std = ref<string>("");
const ng_stock_rf_pitch = ref<string>("");
const trace_rf_inp_std = ref<string>("");
const unloader_rf_std = ref<string>("");
const unloader_rf_pitch = ref<string>("");
const temp_rf_top_ch1 = ref<number>(0);
const temp_rf_top_ch2 = ref<number>(0);
const temp_rf_top_ch3 = ref<number>(0);
const temp_rf_top_ch4 = ref<number>(0);
const temp_rf_top_ch5 = ref<number>(0);
const temp_rf_top_ch6 = ref<number>(0);
const temp_rf_top_ch7 = ref<number>(0);
const temp_rf_top_ch8 = ref<number>(0);
const temp_rf_top_ch9 = ref<number>(0);
const temp_rf_top_ch10 = ref<number>(0);
const temp_rf_btm_ch1 = ref<number>(0);
const temp_rf_btm_ch2 = ref<number>(0);
const temp_rf_btm_ch3 = ref<number>(0);
const temp_rf_btm_ch4 = ref<number>(0);
const temp_rf_btm_ch5 = ref<number>(0);
const temp_rf_btm_ch6 = ref<number>(0);
const temp_rf_btm_ch7 = ref<number>(0);
const temp_rf_btm_ch8 = ref<number>(0);
const temp_rf_btm_ch9 = ref<number>(0);
const temp_rf_btm_ch10 = ref<number>(0);

const db_glue = ref<string[]>([]);
const db_solder = ref<string[]>([]);
const funcPCB = ref<{ name: string }[]>([
  { name: "Air blow" },
  { name: "Sticky" },
  { name: "Lonizer" },
]);

watch(
  () => props.pcbno,
  (newValue) => {
    printer_prg.value = newValue || "";
  }
);

watch(
  () => props.prgnm,
  (newValue) => {
    glue_prg.value = newValue || "";
    solder_prgnm.value = newValue || "";
    prg_ref_mount1.value = newValue || "";
    prg_ref_mount2.value = newValue || "";
    prg_ref_mount3.value = newValue || "";
    prg_ref_mount4.value = newValue || "";
    prg_ref_inspct.value = newValue || "";
    prg_rf_reflow.value = newValue || "";
    prg_rf_auto.value = newValue || "";
  }
);

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
const mounter_ref_use = computed<boolean>(
  () => mounter_ref_inp.value === "Use"
);
const mounter2_ref_use = computed<boolean>(
  () => mounter2_ref_inp.value === "Use"
);
const mounter3_ref_use = computed<boolean>(
  () => mounter3_ref_inp.value === "Use"
);
const mounter4_ref_use = computed<boolean>(
  () => mounter4_ref_inp.value === "Use"
);
const mounter_ref_inps_std = computed<boolean>(
  () => mounter_ref_inps.value === "Use"
);
const reflow_rf_use_std = computed<boolean>(
  () => reflow_rf_std.value === "Use"
);
const oxygen_rf_std_use = computed<boolean>(
  () => oxygen_rf_reflow_std.value === "Use"
);
const auto_rf_inps_std = computed<boolean>(() => auto_rf_inps.value === "Use");
const ng_stock_rf_std_use = computed<boolean>(
  () => ng_stock_rf_std.value === "Use"
);
const unloader_rf_std_use = computed<boolean>(
  () => unloader_rf_std.value === "Use"
);
const empno = computed<string>(() => props.empno || "");

const id_rf = ref<string>("");
id_rf.value = props.id || "";

// คำนวณค่าผลต่าง
const diff = computed(() => temp_rf_top_ch1.value - temp_rf_btm_ch1.value);
const diff2 = computed(() => temp_rf_top_ch2.value - temp_rf_btm_ch2.value);
const diff3 = computed(() => temp_rf_top_ch3.value - temp_rf_btm_ch3.value);
const diff4 = computed(() => temp_rf_top_ch4.value - temp_rf_btm_ch4.value);
const diff5 = computed(() => temp_rf_top_ch5.value - temp_rf_btm_ch5.value);
const diff6 = computed(() => temp_rf_top_ch6.value - temp_rf_btm_ch6.value);
const diff7 = computed(() => temp_rf_top_ch7.value - temp_rf_btm_ch7.value);
const diff8 = computed(() => temp_rf_top_ch8.value - temp_rf_btm_ch8.value);
const diff9 = computed(() => temp_rf_top_ch9.value - temp_rf_btm_ch9.value);
const diff10 = computed(() => temp_rf_top_ch10.value - temp_rf_btm_ch10.value);

// เช็คสีตามเงื่อนไข
const diffColorch1 = computed(() =>
  diff.value > 5 ? "text-red-500" : "text-green-500"
);

const diffColorch2 = computed(() =>
  diff2.value > 5 ? "text-red-500" : "text-green-500"
);

const diffColorch3 = computed(() =>
  diff3.value > 5 ? "text-red-500" : "text-green-500"
);

const diffColorch4 = computed(() =>
  diff4.value > 5 ? "text-red-500" : "text-green-500"
);

const diffColorch5 = computed(() =>
  diff5.value > 5 ? "text-red-500" : "text-green-500"
);

const diffColorch6 = computed(() =>
  diff6.value > 5 ? "text-red-500" : "text-green-500"
);

const diffColorch7 = computed(() =>
  diff7.value > 5 ? "text-red-500" : "text-green-500"
);

const diffColorch8 = computed(() =>
  diff8.value > 5 ? "text-red-500" : "text-green-500"
);

const diffColorch9 = computed(() =>
  diff9.value > 5 ? "text-red-500" : "text-green-500"
);

const diffColorch10 = computed(() =>
  diff10.value > 5 ? "text-red-500" : "text-green-500"
);

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
      cooling_rf_std: cooling_rf_std.value,
      auto_rf_inps: auto_rf_inps.value,
      prg_rf_auto: prg_rf_auto.value,
      ng_stock_rf_std: ng_stock_rf_std.value,
      ng_stock_rf_pitch: ng_stock_rf_pitch.value,
      trace_rf_inp_std: trace_rf_inp_std.value,
      unloader_rf_std: unloader_rf_std.value,
      unloader_rf_pitch: unloader_rf_pitch.value,
      temp_rf_top_ch1: temp_rf_top_ch1.value,
      temp_rf_top_ch2: temp_rf_top_ch2.value,
      temp_rf_top_ch3: temp_rf_top_ch3.value,
      temp_rf_top_ch4: temp_rf_top_ch4.value,
      temp_rf_top_ch5: temp_rf_top_ch5.value,
      temp_rf_top_ch6: temp_rf_top_ch6.value,
      temp_rf_top_ch7: temp_rf_top_ch7.value,
      temp_rf_top_ch8: temp_rf_top_ch8.value,
      temp_rf_top_ch9: temp_rf_top_ch9.value,
      temp_rf_top_ch10: temp_rf_top_ch10.value,
      temp_rf_btm_ch1: temp_rf_btm_ch1.value,
      temp_rf_btm_ch2: temp_rf_btm_ch2.value,
      temp_rf_btm_ch3: temp_rf_btm_ch3.value,
      temp_rf_btm_ch4: temp_rf_btm_ch4.value,
      temp_rf_btm_ch5: temp_rf_btm_ch5.value,
      temp_rf_btm_ch6: temp_rf_btm_ch6.value,
      temp_rf_btm_ch7: temp_rf_btm_ch7.value,
      temp_rf_btm_ch8: temp_rf_btm_ch8.value,
      temp_rf_btm_ch9: temp_rf_btm_ch9.value,
      temp_rf_btm_ch10: temp_rf_btm_ch10.value,
      empno: empno.value,
      id: props.id,
    };

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
  } catch (error) {
    console.log(error);
  }
};

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
  fetchDB();
});
</script>
