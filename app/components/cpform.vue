<template>
    <v-form @submit.prevent="handleCPSubmit">
        <div class="flex gap-3 align-center">
            <div class="flex gap-2 align-center">
                <h1>Employee ID :</h1>
                <span>
                    <input type="text" class="w-full px-3 py-2 border border-gray-800 rounded-lg focus:outline-none"
                        v-model="empno" />
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
                <v-radio-group inline class="gap-4" v-model="func">
                    <v-radio label="Air blow" value="Air blow"></v-radio>
                    <v-radio label="Sticky" value="Sticky"></v-radio>
                    <v-radio label="lonizer" value="lonizer"></v-radio>
                    <v-radio label="Etc." value="etc"> </v-radio>
                </v-radio-group>
                <v-text-field variant="outlined" density="compact" v-model="etc_details" v-if="etc_std" />
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
            <div v-if="glu_std">
                <v-col cols="12" md="20">
                    <div class="mt-3 font-semibold">5.1 Prgram name</div>
                    <v-radio-group inline class="gap-4" v-model="prg_nm">
                        <v-radio label="Referent Assembly chart part list for AM"
                            value="Referent Assembly chart part list for AM"></v-radio>
                    </v-radio-group>
                    <div class="mt-1 font-semibold">5.2 Glue Number</div>
                    <v-radio-group inline class="gap-4" v-model="glu_num">
                        <v-radio label="Referent Assembly chart part list for AM"
                            value="Referent Assembly chart part list for AM"></v-radio>
                    </v-radio-group>
                    <div class="mt-1 font-semibold">5.3 Head Unit</div>
                    <v-radio-group inline class="gap-4" v-model="headunit">
                        <v-radio label="Head no.1" value="Head no.1"></v-radio>
                        <v-radio label="Head no.2" value="Head no.2"></v-radio>
                        <v-radio label="Head no.3" value="Head no.3"></v-radio>
                    </v-radio-group>
                    <div class="mt-1 font-semibold">5.4 Backup pin standard no.</div>
                    <v-text-field variant="outlined" density="compact" v-model="bpst_detail" v-if="confirm_bpst_std" />
                    <v-switch v-model="confirm_bpst" color="primary" label="Confirm OK" value="OK"
                        hide-details></v-switch>
                </v-col>
            </div>
        </v-row>
        <v-row no-gutters>
            <v-col cols="6" md="4">
                <div class="mt-3 font-semibold">6) Glue (M/C #2)</div>
                <v-radio-group inline class="gap-4" v-model="glu2_inp">
                    <v-radio label="Use" value="Use"></v-radio>
                    <v-radio label="Not Use" value="Not Use"></v-radio>
                </v-radio-group>
            </v-col>
            <div v-if="glu2_std">
                <v-col cols="12" md="20">
                    <div class="mt-3 font-semibold">6.1 Prgram name</div>
                    <v-radio-group inline class="gap-4" v-model="prg2_nm">
                        <v-radio label="Referent Assembly chart part list for AM"
                            value="Referent Assembly chart part list for AM"></v-radio>
                    </v-radio-group>
                    <div class="mt-1 font-semibold">6.2 Glue Number</div>
                    <v-radio-group inline class="gap-4" v-model="glu2_num">
                        <v-radio label="Referent Assembly chart part list for AM"
                            value="Referent Assembly chart part list for AM"></v-radio>
                    </v-radio-group>
                    <div class="mt-1 font-semibold">6.3 Head Unit</div>
                    <v-radio-group inline class="gap-4" v-model="headunit2">
                        <v-radio label="Head no.1" value="Head no.1"></v-radio>
                        <v-radio label="Head no.2" value="Head no.2"></v-radio>
                        <v-radio label="Head no.3" value="Head no.3"></v-radio>
                    </v-radio-group>
                    <div class="mt-1 font-semibold">6.4 Backup pin standard no.</div>
                    <v-text-field variant="outlined" density="compact" v-model="bpst2_detail"
                        v-if="confirm_bpst2_std" />
                    <v-switch v-model="confirm_bpst2" color="primary" label="Confirm OK" value="OK"
                        hide-details></v-switch>
                </v-col>
            </div>
        </v-row>
        <v-row no-gutters>
            <v-col cols="6" md="4">
                <div class="mt-3 font-semibold">7) Mounter (M/C #1)</div>
                <v-radio-group inline class="gap-4" v-model="mounter_inp">
                    <v-radio label="Use" value="Use"></v-radio>
                    <v-radio label="Not Use" value="Not Use"></v-radio>
                </v-radio-group>
            </v-col>
            <div v-if="mounter_inp_std">
                <v-col cols="12" md="20">
                    <div class="mt-3 font-semibold">7.1 Program name</div>
                    <v-radio-group inline class="gap-4" v-model="prg_mount1">
                        <v-radio label="Referent Assembly chart part list for AM"
                            value="Referent Assembly chart part list for AM"></v-radio>
                    </v-radio-group>
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
            </div>
        </v-row>

        <v-row no-gutters>
            <v-col cols="6" md="4">
                <div class="mt-3 font-semibold">8) Mounter (M/C #2)</div>
                <v-radio-group inline class="gap-4" v-model="mounter2_inp">
                    <v-radio label="Use" value="Use"></v-radio>
                    <v-radio label="Not Use" value="Not Use"></v-radio>
                </v-radio-group>
            </v-col>
            <div v-if="mounter2_inp_std">
                <v-col cols="12" md="20">
                    <div class="mt-3 font-semibold">8.1 Program name</div>
                    <v-radio-group inline class="gap-4" v-model="prg_mount2">
                        <v-radio label="Referent Assembly chart part list for AM"
                            value="Referent Assembly chart part list for AM"></v-radio>
                    </v-radio-group>
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
            </div>
        </v-row>
        <v-row no-gutters>
            <v-col cols="6" md="4">
                <div class="mt-3 font-semibold">9) Mounter (M/C #3)</div>
                <v-radio-group inline class="gap-4" v-model="mounter3_inp">
                    <v-radio label="Use" value="Use"></v-radio>
                    <v-radio label="Not Use" value="Not Use"></v-radio>
                </v-radio-group>
            </v-col>
            <div v-if="mounter3_inp_std">
                <v-col cols="12" md="20">
                    <div class="mt-3 font-semibold">9.1 Program name</div>
                    <v-radio-group inline class="gap-4" v-model="prg_mount3">
                        <v-radio label="Referent Assembly chart part list for AM"
                            value="Referent Assembly chart part list for AM"></v-radio>
                    </v-radio-group>
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
            </div>
        </v-row>
        <v-row no-gutters>
            <v-col cols="6" md="4">
                <div class="mt-3 font-semibold">10) Mounter (M/C #4)</div>
                <v-radio-group inline class="gap-4" v-model="mounter4_inp">
                    <v-radio label="Use" value="Use"></v-radio>
                    <v-radio label="Not Use" value="Not Use"></v-radio>
                </v-radio-group>
            </v-col>
            <div v-if="mounter4_inp_std">
                <v-col cols="12" md="20">
                    <div class="mt-3 font-semibold">10.1 Program name</div>
                    <v-radio-group inline class="gap-4" v-model="prg_mount4">
                        <v-radio label="Referent Assembly chart part list for AM"
                            value="Referent Assembly chart part list for AM"></v-radio>
                    </v-radio-group>
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
            </div>
        </v-row>
        <v-row no-gutters>
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
                    <v-radio-group inline class="gap-4" v-model="prg_inspct">
                        <v-radio label="Referent Assembly chart part list for AM"
                            value="Referent Assembly chart part list for AM"></v-radio>
                        <!-- <v-radio label="Not Use" value="Not Use"></v-radio> -->
                    </v-radio-group>
                </v-col>
            </div>
        </v-row>
        <v-row no-gutters>
            <v-col cols="6" md="4">
                <div class="mt-3 font-semibold">12) Reflow</div>
                <v-radio-group inline class="gap-4" v-model="reflow_std">
                    <v-radio label="Use" value="Use"></v-radio>
                    <v-radio label="Not Use" value="Not Use"></v-radio>
                </v-radio-group>
            </v-col>
            <div v-if="reflow_use_std">
                <v-col cols="12" md="20">
                    <div class="mt-3 font-semibold">12.1 Program name</div>
                    <v-radio-group inline class="gap-4" v-model="prg_reflow">
                        <v-radio label="Referent Assembly chart part list for AM"
                            value="Referent Assembly chart part list for AM"></v-radio>
                        <!-- <v-radio label="Not Use" value="Not Use"></v-radio> -->
                    </v-radio-group>
                    <div class="mt-3 font-semibold">12.2 Oxygen</div>
                    <v-radio-group inline class="gap-4" v-model="oxygen_reflow_std">
                        <v-radio label="Use" value="Use"></v-radio>
                        <v-radio label="Not Use" value="Not Use"></v-radio>
                    </v-radio-group>
                    <v-text-field variant="outlined" density="compact" v-model="oxygen_use" v-if="oxygen_std_use" />
                    <div class="mt-3 font-semibold">12.3 PCB Supporter</div>
                    <v-radio-group inline class="gap-4" v-model="sup_reflow_std">
                        <v-radio label="Use" value="Use"></v-radio>
                        <v-radio label="Not Use" value="Not Use"></v-radio>
                    </v-radio-group>
                    <div class="mt-3 font-semibold">12.4 Temperature profile</div>
                    <v-radio-group inline class="gap-4" v-model="temp_std">
                        <v-radio label="Pass" value="Pass"></v-radio>
                        <v-radio label="No pass" value="No pass"></v-radio>
                    </v-radio-group>
                </v-col>
            </div>
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
            <div v-if="auto_inps_std">
                <v-col cols="12" md="20">
                    <div class="mt-3 font-semibold">Program name</div>
                    <v-radio-group inline class="gap-4" v-model="prg_auto">
                        <v-radio label="Referent Assembly chart part list for AM"
                            value="Referent Assembly chart part list for AM"></v-radio>
                        <!-- <v-radio label="Not Use" value="Not Use"></v-radio> -->
                    </v-radio-group>
                </v-col>
            </div>
        </v-row>
        <v-row no-gutters>
            <v-col cols="6" md="4">
                <div class="mt-3 font-semibold">15) NG Stocker</div>
                <v-radio-group inline class="gap-4" v-model="ng_stock_std">
                    <v-radio label="Use" value="Use"></v-radio>
                    <v-radio label="Not Use" value="Not Use"></v-radio>
                </v-radio-group>
            </v-col>
            <div v-if="ng_stock_std_use">
                <v-col cols="12" md="20">
                    <div class="mt-3 font-semibold">Pitch Setting</div>
                    <v-radio-group inline class="gap-4" v-model="ng_stock_pitch">
                        <v-radio label="10 mm." value="10 mm."></v-radio>
                        <v-radio label="20 mm." value="20 mm."></v-radio>
                        <v-radio label="30 mm." value="30 mm."></v-radio>
                    </v-radio-group>
                </v-col>
            </div>
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
            <div v-if="unloader_std_use">
                <v-col cols="12" md="20">
                    <div class="mt-3 font-semibold">Pitch Setting</div>
                    <v-radio-group inline class="gap-4" v-model="unloader_pitch">
                        <v-radio label="10 mm." value="10 mm."></v-radio>
                        <v-radio label="20 mm." value="20 mm."></v-radio>
                        <v-radio label="30 mm." value="30 mm."></v-radio>
                    </v-radio-group>
                </v-col>
            </div>
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
import { ref, computed, onMounted } from "vue";
import axios from "axios";
import Swal from "sweetalert2";

const props = defineProps({
    id: String,
    won_chn: String,
    model_chn: String,
    empno: String,
});

const hrec_cp_id = ref<string>("");
const id_cp = ref<string>("");

/**
 * TODO: สร้างตัวแปรรับค่าจาก Input Form
 */
const load_inp = ref<string>("");
const pitch = ref<string>("");
const stack_inp = ref<string>("");
const trace_inp = ref<string>("");
const func = ref<string>("");
const cln_inp = ref<string>("");
const etc_details = ref<string>("");
const prg_nm = ref<string>("");
const glu_num = ref<string>("");
const headunit = ref<string>("");
const bpst_detail = ref<string>("");
const prg2_nm = ref<string>("");
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
const prg_mount1 = ref<string>("");
const noz_mount1 = ref<string>("");
const sup_mount1 = ref<string>("");
const prg_mount2 = ref<string>("");
const noz_mount2 = ref<string>("");
const sup_mount2 = ref<string>("");
const prg_mount3 = ref<string>("");
const noz_mount3 = ref<string>("");
const sup_mount3 = ref<string>("");
const prg_mount4 = ref<string>("");
const noz_mount4 = ref<string>("");
const sup_mount4 = ref<string>("");
const mount_inps = ref<string>("");
const prg_inspct = ref<string>("");
const reflow_std = ref<string>("");
const prg_reflow = ref<string>("");
const oxygen_reflow_std = ref<string>("");
const oxygen_use = ref<string>("");
const sup_reflow_std = ref<string>("");
const temp_std = ref<string>("");
const cooling_std = ref<string>("");
const auto_inps = ref<string>("");
const prg_auto = ref<string>("");
const ng_stock_std = ref<string>("");
const ng_stock_pitch = ref<string>("");
const trace_inp_std = ref<string>("");
const unloader_std = ref<string>("");
const unloader_pitch = ref<string>("");

// ใช้ string หรือ boolean ที่แน่นอน
/**
 * TODO: สร้างตัวแปรรับค่าสถานะการเลือกให้แสดงข้อมูล input
 */
const pitch_std = computed<boolean>(() => load_inp.value === "Use");
const func_std = computed<boolean>(() => cln_inp.value === "Use");
const etc_std = computed<boolean>(() => func.value === "etc");
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
const oxygen_std_use = computed<boolean>(() => oxygen_reflow_std.value === "Use");
const auto_inps_std = computed<boolean>(() => auto_inps.value === "Use");
const ng_stock_std_use = computed<boolean>(() => ng_stock_std.value === "Use");
const unloader_std_use = computed<boolean>(() => unloader_std.value === "Use");
const empno = computed<string>(() => props.empno || "");

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
            prg_reflow: prg_reflow.value,
            oxygen_reflow_std: oxygen_reflow_std.value,
            oxygen_use: oxygen_use.value,
            sup_reflow_std: sup_reflow_std.value,
            temp_std: temp_std.value,
            cooling_std: cooling_std.value,
            auto_inps: auto_inps.value,
            prg_auto: prg_auto.value,
            ng_stock_std: ng_stock_std.value,
            ng_stock_pitch: ng_stock_pitch.value,
            trace_inp_std: trace_inp_std.value,
            unloader_std: unloader_std.value,
            unloader_pitch: unloader_pitch.value,
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
    } catch (error) {
        console.log(error);
    }
};
</script>
