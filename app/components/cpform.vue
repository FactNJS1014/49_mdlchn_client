<template>
  <v-form @submit.prevent="handleCPSubmit">
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

      <input type="hidden" v-model="hrec_cp_id" />
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
        <v-radio-group inline class="gap-4" v-model="pitch">
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
        <div class="mt-3 font-semibold">5) Glue (M/C #1)</div>
        <v-radio-group inline class="gap-4" v-model="glu_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="glu_std">
        <div class="mt-3 font-semibold">5.1 Prgram name</div>
        <v-text-field variant="outlined" density="compact" v-model="prg_nm" />
        <!-- <v-radio-group inline class="gap-4" v-model="prg_nm">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
        <div class="mt-1 font-semibold">5.2 Glue Number</div>
        <v-select
          v-model="glu_num"
          variant="outlined"
          rounded="md"
          :items="db_glue"
          item-title="SAG_SUBMATNUM"
        >
        </v-select>
        <div class="mt-1 font-semibold">5.3 Head Unit</div>
        <v-radio-group inline class="gap-4" v-model="headunit">
          <v-radio label="Head no.1" value="Head no.1"></v-radio>
          <v-radio label="Head no.2" value="Head no.2"></v-radio>
          <v-radio label="Head no.3" value="Head no.3"></v-radio>
        </v-radio-group>
        <div class="mt-1 font-semibold">5.4 Backup pin standard no.</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="bpst_detail"
          v-if="confirm_bpst_std"
        />
        <v-switch
          v-model="confirm_bpst"
          color="primary"
          label="Confirm OK"
          value="OK"
          hide-details
        ></v-switch>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">6) Glue (M/C #2)</div>
        <v-radio-group inline class="gap-4" v-model="glu2_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="glu2_std">
        <div class="mt-3 font-semibold">6.1 Prgram name</div>
        <v-text-field variant="outlined" density="compact" v-model="prg2_nm" />
        <!-- <v-radio-group inline class="gap-4" v-model="prg2_nm">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
        <div class="mt-1 font-semibold">6.2 Glue Number</div>
        <v-select
          v-model="glu2_num"
          variant="outlined"
          rounded="md"
          :items="db_glue"
          item-title="SAG_SUBMATNUM"
        >
        </v-select>
        <div class="mt-1 font-semibold">6.3 Head Unit</div>
        <v-radio-group inline class="gap-4" v-model="headunit2">
          <v-radio label="Head no.1" value="Head no.1"></v-radio>
          <v-radio label="Head no.2" value="Head no.2"></v-radio>
          <v-radio label="Head no.3" value="Head no.3"></v-radio>
        </v-radio-group>
        <div class="mt-1 font-semibold">6.4 Backup pin standard no.</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="bpst2_detail"
          v-if="confirm_bpst2_std"
        />
        <v-switch
          v-model="confirm_bpst2"
          color="primary"
          label="Confirm OK"
          value="OK"
          hide-details
        ></v-switch>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">7) Mounter (M/C #1)</div>

        <v-radio-group inline class="gap-4" v-model="mounter_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="mounter_inp_std">
        <div class="mt-3 font-semibold">7.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_mount1"
        />
        <!-- <v-radio-group inline class="gap-4" v-model="prg_mount1">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
        <div class="mt-3 font-semibold">7.2 Nozzle setting</div>
        <v-radio-group inline class="gap-4" v-model="noz_mount1">
          <v-radio label="Automatic" value="Automatic"></v-radio>
          <v-radio label="Manual" value="Manual"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">7.3 Support PCB</div>
        <v-radio-group inline class="gap-4" v-model="sup_mount1">
          <v-radio label="Pin" value="Pin"></v-radio>
          <v-radio label="Magnet" value="Magnet"></v-radio>
          <v-radio label="Sponge" value="Sponge"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>

    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">8) Mounter (M/C #2)</div>
        <v-radio-group inline class="gap-4" v-model="mounter2_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="mounter2_inp_std">
        <div class="mt-3 font-semibold">8.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_mount2"
        />
        <!-- <v-radio-group inline class="gap-4" v-model="prg_mount2">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
        <div class="mt-3 font-semibold">8.2 Nozzle setting</div>
        <v-radio-group inline class="gap-4" v-model="noz_mount2">
          <v-radio label="Automatic" value="Automatic"></v-radio>
          <v-radio label="Manual" value="Manual"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">8.3 Support PCB</div>
        <v-radio-group inline class="gap-4" v-model="sup_mount2">
          <v-radio label="Pin" value="Pin"></v-radio>
          <v-radio label="Magnet" value="Magnet"></v-radio>
          <v-radio label="Sponge" value="Sponge"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">9) Mounter (M/C #3)</div>
        <v-radio-group inline class="gap-4" v-model="mounter3_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="mounter3_inp_std">
        <div class="mt-3 font-semibold">9.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_mount3"
        />
        <!-- <v-radio-group inline class="gap-4" v-model="prg_mount3">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
        <div class="mt-3 font-semibold">9.2 Nozzle setting</div>
        <v-radio-group inline class="gap-4" v-model="noz_mount3">
          <v-radio label="Automatic" value="Automatic"></v-radio>
          <v-radio label="Manual" value="Manual"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">9.3 Support PCB</div>
        <v-radio-group inline class="gap-4" v-model="sup_mount3">
          <v-radio label="Pin" value="Pin"></v-radio>
          <v-radio label="Magnet" value="Magnet"></v-radio>
          <v-radio label="Sponge" value="Sponge"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">10) Mounter (M/C #4)</div>
        <v-radio-group inline class="gap-4" v-model="mounter4_inp">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="mounter4_inp_std">
        <div class="mt-3 font-semibold">10.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_mount4"
          :value="props.prgnm"
        />
        <!-- <v-radio-group inline class="gap-4" v-model="prg_mount4">
            <v-radio  :value="props.prgnm"></v-radio>
          </v-radio-group> -->
        <div class="mt-3 font-semibold">10.2 Nozzle setting</div>
        <v-radio-group inline class="gap-4" v-model="noz_mount4">
          <v-radio label="Automatic" value="Automatic"></v-radio>
          <v-radio label="Manual" value="Manual"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">10.3 Support PCB</div>
        <v-radio-group inline class="gap-4" v-model="sup_mount4">
          <v-radio label="Pin" value="Pin"></v-radio>
          <v-radio label="Magnet" value="Magnet"></v-radio>
          <v-radio label="Sponge" value="Sponge"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">11) Mounter Inspector</div>
        <v-radio-group inline class="gap-4" v-model="mount_inps">
          <v-radio label="Use" value="Use" />
          <v-radio label="Not Use" value="Not Use" />
        </v-radio-group>
      </v-col>

      <!-- ทำให้เหมือน Mounter#04 -->
      <v-col cols="12" md="4" v-if="mount_inps_std">
        <div class="mt-3 font-semibold">11.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prg_inspct"
        />
      </v-col>
    </v-row>

    <!-- <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">11) Mounter Inspector</div>
        <v-radio-group inline class="gap-4" v-model="mount_inps">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>
      <div v-if="mount_inps_std">
        <v-col cols="12" md="20">
          <div class="mt-3 font-semibold">11.1 Program name</div>
          <v-text-field variant="outlined" density="compact" v-model="prg_inspct" 
            :value="props.prgnm" />
        </v-col>
      </div>
    </v-row> -->
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">12) Reflow</div>
        <v-radio-group inline class="gap-4" v-model="reflow_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="reflow_use_std">
        <div class="mt-3 font-semibold">12.1 Program name</div>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="prog_reflow"
        />

        <div class="mt-3 font-semibold">12.2 Oxygen</div>
        <v-radio-group inline class="gap-4" v-model="oxygen_reflow_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
        <v-text-field
          variant="outlined"
          density="compact"
          v-model="oxygen_use"
          v-if="oxygen_std_use"
        />
        <div class="mt-3 font-semibold">12.3 PCB Supporter</div>
        <v-radio-group inline class="gap-4" v-model="sup_reflow_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
        <div class="mt-3 font-semibold">12.4 Temperature profile</div>
        <div class="flex justify-between gap-3">
          <div class="mt-2">
            <div>TOP Side</div>
            <div class="mt-3">CH-1</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_top_ch1"
            />
            <div class="mt-2">CH-2</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_top_ch2"
            />
            <div class="mt-2">CH-3</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_top_ch3"
            />
            <div class="mt-2">CH-4</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_top_ch4"
            />
            <div class="mt-2">CH-5</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_top_ch5"
            />
            <div class="mt-2">CH-6</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_top_ch6"
            />
            <div class="mt-2">CH-7</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_top_ch7"
            />
            <div class="mt-2">CH-8</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_top_ch8"
            />
            <div class="mt-2">CH-9</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_top_ch9"
            />
            <div class="mt-2">CH-10</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_top_ch10"
            />
          </div>
          <div class="mt-2">
            <div>BOTTOM Side</div>
            <div class="mt-3">CH-1</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_btm_ch1"
              :class="diffColorch1"
            />
            <div class="mt-2">CH-2</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_btm_ch2"
              :class="diffColorch2"
            />
            <div class="mt-2">CH-3</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_btm_ch3"
              :class="diffColorch3"
            />
            <div class="mt-2">CH-4</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_btm_ch4"
              :class="diffColorch4"
            />
            <div class="mt-2">CH-5</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_btm_ch5"
              :class="diffColorch5"
            />
            <div class="mt-2">CH-6</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_btm_ch6"
              :class="diffColorch6"
            />
            <div class="mt-2">CH-7</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_btm_ch7"
              :class="diffColorch7"
            />
            <div class="mt-2">CH-8</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_btm_ch8"
              :class="diffColorch8"
            />
            <div class="mt-2">CH-9</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_btm_ch9"
              :class="diffColorch9"
            />
            <div class="mt-2">CH-10</div>
            <v-number-input
              variant="outlined"
              density="compact"
              v-model="temp_btm_ch10"
              :class="diffColorch10"
            />
          </div>
        </div>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">13) PCB Cooling</div>
        <v-radio-group inline class="gap-4" v-model="cooling_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">14) Auto Optic Inspection</div>
        <v-radio-group inline class="gap-4" v-model="auto_inps">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="auto_inps_std">
        <div class="mt-3 font-semibold">Program name</div>
        <v-text-field variant="outlined" density="compact" v-model="prg_auto" />
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">15) NG Stocker</div>
        <v-radio-group inline class="gap-4" v-model="ng_stock_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="ng_stock_std_use">
        <div class="mt-3 font-semibold">Pitch Setting</div>
        <v-radio-group inline class="gap-4" v-model="ng_stock_pitch">
          <v-radio label="10 mm." value="10 mm."></v-radio>
          <v-radio label="20 mm." value="20 mm."></v-radio>
          <v-radio label="30 mm." value="30 mm."></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">16) Tracebility Input</div>
        <v-radio-group inline class="gap-4" v-model="trace_inp_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col cols="6" md="4">
        <div class="mt-3 font-semibold">17) Unloader Input</div>
        <v-radio-group inline class="gap-4" v-model="unloader_std">
          <v-radio label="Use" value="Use"></v-radio>
          <v-radio label="Not Use" value="Not Use"></v-radio>
        </v-radio-group>
      </v-col>

      <v-col cols="12" md="4" v-if="unloader_std_use">
        <div class="mt-3 font-semibold">Pitch Setting</div>
        <v-radio-group inline class="gap-4" v-model="unloader_pitch">
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
import { ref, computed, onMounted, watch, watchEffect } from "vue";
import axios from "axios";
import Swal from "sweetalert2";

const props = defineProps({
  id: String,
  won_chn: String,
  model_chn: String,
  empno: String,
  prgnm: String,
  cus: String,
});

const hrec_cp_id = ref<string>("");
const id_cp = ref<string>("");

// console.log(props.prgnm);

/**
 * TODO: สร้างตัวแปรรับค่าจาก Input Form
 */
const load_inp = ref<string>("");
const pitch = ref<string>("");
const stack_inp = ref<string>("");
const trace_inp = ref<string>("");
const func = ref<string[]>([]);
const cln_inp = ref<string>("");
const etc_details = ref<string>("");
const prg_nm = ref<string>(props.prgnm || "");
const glu_num = ref<string>("");
const headunit = ref<string>("");
const bpst_detail = ref<string>("");
const prg2_nm = ref<string>(props.prgnm || "");
const glu2_num = ref<string>("");
const headunit2 = ref<string>("");
const bpst2_detail = ref<string>("");
const confirm_bpst = ref<string>("");
const glu_inp = ref<string>("");
const confirm_bpst2 = ref<string>("");
const glu2_inp = ref<string>("");
const mounter_inp = ref<string>("");
const mounter2_inp = ref<string>("");
const mounter3_inp = ref<string>("");
const mounter4_inp = ref<string>("");
const prg_mount1 = ref<string>(props.prgnm || "");
const noz_mount1 = ref<string>("");
const sup_mount1 = ref<string>("");
const prg_mount2 = ref<string>(props.prgnm || "");
const noz_mount2 = ref<string>("");
const sup_mount2 = ref<string>("");
const prg_mount3 = ref<string>(props.prgnm || "");
const noz_mount3 = ref<string>("");
const sup_mount3 = ref<string>("");
const prg_mount4 = ref<string>(props.prgnm || "");
const noz_mount4 = ref<string>("");
const sup_mount4 = ref<string>("");
const mount_inps = ref<string>("");
const prg_inspct = ref<string>(props.prgnm || "");
const reflow_std = ref<string>("");
const prog_reflow = ref<string>(props.prgnm || "");
const oxygen_reflow_std = ref<string>("");
const oxygen_use = ref<string>("");
const sup_reflow_std = ref<string>("");
const temp_top_ch1 = ref<number>(0);
const temp_top_ch2 = ref<number>(0);
const temp_top_ch3 = ref<number>(0);
const temp_top_ch4 = ref<number>(0);
const temp_top_ch5 = ref<number>(0);
const temp_top_ch6 = ref<number>(0);
const temp_top_ch7 = ref<number>(0);
const temp_top_ch8 = ref<number>(0);
const temp_top_ch9 = ref<number>(0);
const temp_top_ch10 = ref<number>(0);
const temp_btm_ch1 = ref<number>(0);
const temp_btm_ch2 = ref<number>(0);
const temp_btm_ch3 = ref<number>(0);
const temp_btm_ch4 = ref<number>(0);
const temp_btm_ch5 = ref<number>(0);
const temp_btm_ch6 = ref<number>(0);
const temp_btm_ch7 = ref<number>(0);
const temp_btm_ch8 = ref<number>(0);
const temp_btm_ch9 = ref<number>(0);
const temp_btm_ch10 = ref<number>(0);

const cooling_std = ref<string>("");
const auto_inps = ref<string>("");
const prg_auto = ref<string>(props.prgnm || "");
const ng_stock_std = ref<string>("");
const ng_stock_pitch = ref<string>("");
const trace_inp_std = ref<string>("");
const unloader_std = ref<string>("");
const unloader_pitch = ref<string>("");

const funcPCB = ref<{ name: string }[]>([
  { name: "Air blow" },
  { name: "Sticky" },
  { name: "Lonizer" },
]);

watch(
  () => props.prgnm,
  (newValue) => {
    prog_reflow.value = newValue || "";
    prg_nm.value = newValue || "";
    prg2_nm.value = newValue || "";
    prg_inspct.value = newValue || "";
    prg_auto.value = newValue || "";
    prg_mount1.value = newValue || "";
    prg_mount2.value = newValue || "";
    prg_mount3.value = newValue || "";
    prg_mount4.value = newValue || "";
  }
);

const db_glue = ref<string[]>([]);

// ใช้ string หรือ boolean ที่แน่นอน
/**
 * TODO: สร้างตัวแปรรับค่าสถานะการเลือกให้แสดงข้อมูล input
 */
const pitch_std = computed<boolean>(() => load_inp.value === "Use");
const func_std = computed<boolean>(() => cln_inp.value === "Use");
// const etc_std = computed<boolean>(() => func.value === "etc");
const confirm_bpst_std = computed<boolean>(() => !confirm_bpst.value);
const glu_std = computed<boolean>(() => glu_inp.value === "Use");
const confirm_bpst2_std = computed<boolean>(() => !confirm_bpst2.value);
const glu2_std = computed<boolean>(() => glu2_inp.value === "Use");
const mounter_inp_std = computed<boolean>(() => mounter_inp.value === "Use");
const mounter2_inp_std = computed<boolean>(() => mounter2_inp.value === "Use");
const mounter3_inp_std = computed<boolean>(() => mounter3_inp.value === "Use");
const mounter4_inp_std = computed<boolean>(() => mounter4_inp.value === "Use");
const mount_inps_std = computed<boolean>(() => mount_inps.value === "Use");
const reflow_use_std = computed<boolean>(() => reflow_std.value === "Use");
const oxygen_std_use = computed<boolean>(
  () => oxygen_reflow_std.value === "Use"
);
const auto_inps_std = computed<boolean>(() => auto_inps.value === "Use");
const ng_stock_std_use = computed<boolean>(() => ng_stock_std.value === "Use");
const unloader_std_use = computed<boolean>(() => unloader_std.value === "Use");
const empno = computed<string>(() => props.empno || "");

id_cp.value = props.id || "";
// console.log(obj.TEC_CPHREC_ID);

// คำนวณค่าผลต่าง
const diff = computed(() => temp_top_ch1.value - temp_btm_ch1.value);
const diff2 = computed(() => temp_top_ch2.value - temp_btm_ch2.value);
const diff3 = computed(() => temp_top_ch3.value - temp_btm_ch3.value);
const diff4 = computed(() => temp_top_ch4.value - temp_btm_ch4.value);
const diff5 = computed(() => temp_top_ch5.value - temp_btm_ch5.value);
const diff6 = computed(() => temp_top_ch6.value - temp_btm_ch6.value);
const diff7 = computed(() => temp_top_ch7.value - temp_btm_ch7.value);
const diff8 = computed(() => temp_top_ch8.value - temp_btm_ch8.value);
const diff9 = computed(() => temp_top_ch9.value - temp_btm_ch9.value);
const diff10 = computed(() => temp_top_ch10.value - temp_btm_ch10.value);

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

const handleCPSubmit = async () => {
  try {
    const payload = {
      pitch: pitch.value,
      etc_details: etc_details.value,
      prg_nm: prg_nm.value,
      glu_num: glu_num.value,
      headunit: headunit.value,
      bpst_detail: bpst_detail.value,
      prg2_nm: prg2_nm.value,
      glu2_num: glu2_num.value,
      headunit2: headunit2.value,
      bpst2_detail: bpst2_detail.value,
      load_inp: load_inp.value,
      cln_inp: cln_inp.value,
      func: func.value,
      stack_inp: stack_inp.value,
      trace_inp: trace_inp.value,
      confirm_bpst: confirm_bpst.value,
      glu_inp: glu_inp.value,
      confirm_bpst2: confirm_bpst2.value,
      glu2_inp: glu2_inp.value,
      mounter_inp: mounter_inp.value,
      mounter2_inp: mounter2_inp.value,
      mounter3_inp: mounter3_inp.value,
      mounter4_inp: mounter4_inp.value,
      prg_mount1: prg_mount1.value,
      noz_mount1: noz_mount1.value,
      sup_mount1: sup_mount1.value,
      prg_mount2: prg_mount2.value,
      noz_mount2: noz_mount2.value,
      sup_mount2: sup_mount2.value,
      prg_mount3: prg_mount3.value,
      noz_mount3: noz_mount3.value,
      sup_mount3: sup_mount3.value,
      prg_mount4: prg_mount4.value,
      noz_mount4: noz_mount4.value,
      sup_mount4: sup_mount4.value,
      mount_inps: mount_inps.value,
      prg_inspct: prg_inspct.value,
      reflow_std: reflow_std.value,
      prg_reflow: prog_reflow.value,
      oxygen_reflow_std: oxygen_reflow_std.value,
      oxygen_use: oxygen_use.value,
      sup_reflow_std: sup_reflow_std.value,
      cooling_std: cooling_std.value,
      auto_inps: auto_inps.value,
      prg_auto: prg_auto.value,
      ng_stock_std: ng_stock_std.value,
      ng_stock_pitch: ng_stock_pitch.value,
      trace_inp_std: trace_inp_std.value,
      unloader_std: unloader_std.value,
      unloader_pitch: unloader_pitch.value,
      temp_top_ch1: temp_top_ch1.value,
      temp_top_ch2: temp_top_ch2.value,
      temp_top_ch3: temp_top_ch3.value,
      temp_top_ch4: temp_top_ch4.value,
      temp_top_ch5: temp_top_ch5.value,
      temp_top_ch6: temp_top_ch6.value,
      temp_top_ch7: temp_top_ch7.value,
      temp_top_ch8: temp_top_ch8.value,
      temp_top_ch9: temp_top_ch9.value,
      temp_top_ch10: temp_top_ch10.value,
      temp_btm_ch1: temp_btm_ch1.value,
      temp_btm_ch2: temp_btm_ch2.value,
      temp_btm_ch3: temp_btm_ch3.value,
      temp_btm_ch4: temp_btm_ch4.value,
      temp_btm_ch5: temp_btm_ch5.value,
      temp_btm_ch6: temp_btm_ch6.value,
      temp_btm_ch7: temp_btm_ch7.value,
      temp_btm_ch8: temp_btm_ch8.value,
      temp_btm_ch9: temp_btm_ch9.value,
      temp_btm_ch10: temp_btm_ch10.value,
      empno: empno.value,
      id: props.id,
    };

    const res = await axios.post(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/cpinsert",
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

    console.log(payload);
  } catch (error) {
    console.log(error);
  }
};

const fetchDB = async () => {
  const res = await axios.get(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/settings"
  );
  db_glue.value = res.data.glue;
  // db_solder.value = res.data.solder;
  console.log(res.data.glue);
  console.log(res.data.solder);
};

onMounted(() => {
  /**   TODO: กำหนดค่าเริ่มต้นให้กับตัวแปรจาก props.data_edit เมื่อมีการแก้ไขข้อมูล
   */

  fetchDB();
});
</script>
