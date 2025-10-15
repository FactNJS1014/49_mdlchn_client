<template>
    <v-card>
        <v-data-iterator :items="all_data" :items-per-page="3" :search="search">
            <template v-slot:header>
                <v-toolbar class="px-2 bg-blue-lighten-2">
                    <div class="flex justify-between align-center w-[500px]">
                        <v-text-field v-model="search" density="comfortable" placeholder="Search"
                            prepend-inner-icon="fa fa-magnifying-glass" style="max-width: 300px;" variant="solo"
                            clearable hide-details></v-text-field>
                        <v-text class="text-xl font-weight-bold">
                            Process: CP
                        </v-text>
                    </div>


                </v-toolbar>
            </template>



            <template v-slot:default="{ items }">
                <v-container class="pa-2" fluid>
                    <v-row dense>
                        <v-col v-for="item in items" :key="item.raw.OPR_HREC_ID" cols="auto" md="4">
                            <v-card class="pb-3" border flat>

                                <v-list-item class="mb-2 font-weight-bold">

                                    <template v-slot:title>
                                        <strong class="mb-2 text-h6">Document No. :{{
                                            item.raw.OPR_HREC_ISSUENO
                                            }}</strong>
                                    </template>
                                    <template v-slot:subtitle>
                                        <table class="border border-blue-800">
                                            <tbody>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">LINE:</th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_LINE }}</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border text-sky-800 w-30 pa-2">วันที่บันทึก:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{
                                                        dateFormat(item.raw.OPR_HREC_DATEREC) }}</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Status:</th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_STATUSMDL }}</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">WO# Current:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_WON_CURRENT }}
                                                    </td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Model Current:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_CURMDLNM }}</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Lot Size
                                                        Current:</th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_LOTS }} pcs.</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">WO# Change:</th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_WON_CHANGE }}
                                                    </td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Model Change:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_CHNMDLNM }}</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Lot Size Change:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_LOTS_CHN }} pcs.
                                                    </td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">ECN Status:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_CONTECN }}
                                                    </td>
                                                </tr>
                                                <tr class="border" v-if="item.raw.OPR_HREC_CONTECN === 'Have'">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">ECN Number:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{
                                                        item.raw.OPR_HREC_HAVECONTECN_NO }}

                                                    </td>

                                                </tr>
                                                <tr class="border" v-if="item.raw.OPR_HREC_CONTECN === 'Have'">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">ECN REV.:
                                                    </th>

                                                    <td class="px-2 text-sky-800">{{
                                                        item.raw.OPR_HREC_HAVECONTECN_REV
                                                        }}

                                                    </td>

                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Program Name:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_PRGMNM }}
                                                    </td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Program REV.:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_PRGMREV }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </template>
                                </v-list-item>

                                <div class="px-4 d-flex justify-space-between">
                                    <div class="d-flex align-center text-caption text-medium-emphasis me-1">
                                        <v-btn size="small" variant="tonal" class="bg-green-darken-2" rounded="lg">
                                            <v-icons class="mr-2 fa fa-check"></v-icons>
                                            อนุมัติ</v-btn>
                                        <v-btn size="small" variant="tonal" class="bg-red-darken-2 ms-2" rounded="lg">
                                            <v-icons class="mr-2 fa fa-arrow-right-arrow-left"></v-icons>
                                            ส่งกลับแก้ไข</v-btn>
                                    </div>

                                    <v-btn class="text-none" size="small" variant="flat" border
                                        icon="fa fa-file-lines fa-sm" rounded="lg" @click="dialog_cp(item.raw)">

                                    </v-btn>
                                </div>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>
            </template>

            <template v-slot:footer="{ page, pageCount, prevPage, nextPage }">
                <div class="justify-center d-flex align-center pa-4">
                    <v-btn :disabled="page === 1" density="comfortable" icon="fa fa-angle-left" variant="tonal" rounded
                        @click="prevPage"></v-btn>

                    <div class="mx-2 text-caption">
                        Page {{ page }} of {{ pageCount }}
                    </div>

                    <v-btn :disabled="page >= pageCount" density="comfortable" icon="fa fa-angle-right" variant="tonal"
                        rounded @click="nextPage"></v-btn>
                </div>
            </template>
        </v-data-iterator>
        <v-data-iterator :items="all_data_rf" :items-per-page="3" :search="search_rf" class="mt-2">
            <template v-slot:header>
                <v-toolbar class="px-2 bg-cyan-accent-3">
                    <div class="flex justify-between align-center w-[500px] ">
                        <v-text-field v-model="search_rf" density="comfortable" placeholder="Search"
                            prepend-inner-icon="fa fa-magnifying-glass" style="max-width: 300px;" variant="solo"
                            clearable hide-details></v-text-field>
                        <v-text class="text-xl font-weight-bold">
                            Process: RF
                        </v-text>
                    </div>


                </v-toolbar>
            </template>



            <template v-slot:default="{ items }">
                <v-container class="pa-2" fluid>
                    <v-row dense>
                        <v-col v-for="item in items" :key="item.raw.OPR_HREC_ID" cols="auto" md="4">
                            <v-card class="pb-3" border flat>

                                <v-list-item class="mb-2 font-weight-bold">

                                    <template v-slot:title>
                                        <strong class="mb-2 text-h6">Document No. :{{
                                            item.raw.OPR_HREC_ISSUENO
                                            }}</strong>
                                    </template>
                                    <template v-slot:subtitle>
                                        <table class="border border-blue-800">
                                            <tbody>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">LINE:</th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_LINE }}</td>
                                                </tr>

                                                <tr class="border">
                                                    <th class="text-left border text-sky-800 w-30 pa-2">วันที่บันทึก:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{
                                                        dateFormat(item.raw.OPR_HREC_DATEREC) }}</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Status:</th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_STATUSMDL }}</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">WO# Current:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_WON_CURRENT }}
                                                    </td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Model Current:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_CURMDLNM }}</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Lot Size
                                                        Current:</th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_LOTS }} pcs.</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Process เดิม:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_PROCS_RF }}</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">WO# Change:</th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_WON_CHANGE }}
                                                    </td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Model Change:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_CHNMDLNM }}</td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Lot Size Change:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_LOTS_CHN }} pcs.
                                                    </td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Process Change:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_PROCS_RF_CHN }}
                                                    </td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">ECN Status:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_CONTECN }}
                                                    </td>
                                                </tr>
                                                <tr class="border" v-if="item.raw.OPR_HREC_CONTECN === 'Have'">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">ECN Number:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{
                                                        item.raw.OPR_HREC_HAVECONTECN_NO }}

                                                    </td>

                                                </tr>
                                                <tr class="border" v-if="item.raw.OPR_HREC_CONTECN === 'Have'">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">ECN REV.:
                                                    </th>

                                                    <td class="px-2 text-sky-800">{{
                                                        item.raw.OPR_HREC_HAVECONTECN_REV
                                                        }}

                                                    </td>

                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Program Name:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_PRGMNM }}
                                                    </td>
                                                </tr>
                                                <tr class="border">
                                                    <th class="text-left border pa-2 text-sky-800 w-30">Program REV.:
                                                    </th>
                                                    <td class="px-2 text-sky-800">{{ item.raw.OPR_HREC_PRGMREV }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </template>
                                </v-list-item>

                                <div class="px-4 d-flex justify-space-between">
                                    <div class="d-flex align-center text-caption text-medium-emphasis me-1">
                                        <v-btn size="small" variant="tonal" class="bg-green-darken-2" rounded="lg">
                                            <v-icons class="mr-2 fa fa-check"></v-icons>
                                            อนุมัติ</v-btn>
                                        <v-btn size="small" variant="tonal" class="bg-red-darken-2 ms-2" rounded="lg">
                                            <v-icons class="mr-2 fa fa-arrow-right-arrow-left"></v-icons>
                                            ส่งกลับแก้ไข</v-btn>
                                    </div>

                                    <v-btn class="text-none" size="small" variant="flat" border
                                        icon="fa fa-file-lines fa-sm" rounded="lg">

                                    </v-btn>
                                </div>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>
            </template>

            <template v-slot:footer="{ page, pageCount, prevPage, nextPage }">
                <div class="justify-center d-flex align-center pa-4">
                    <v-btn :disabled="page === 1" density="comfortable" icon="fa fa-angle-left" variant="tonal" rounded
                        @click="prevPage"></v-btn>

                    <div class="mx-2 text-caption">
                        Page {{ page }} of {{ pageCount }}
                    </div>

                    <v-btn :disabled="page >= pageCount" density="comfortable" icon="fa fa-angle-right" variant="tonal"
                        rounded @click="nextPage"></v-btn>
                </div>
            </template>


        </v-data-iterator>
    </v-card>
    <v-dialog v-model="dialog_CP" width="auto">
        <v-card min-width="1300" class="overflow-hidden">
            <template #prepend>
                <v-icons class="fa fa-file-lines fa-lg text-sky-500"></v-icons>
            </template>
            <template #title>
                <div class="flex gap-3">
                    <h1 class="font-weight-bold text-blue-darken-3">Details: {{ items?.OPR_HREC_ISSUENO }},</h1>

                    <h1 class="font-weight-medium text-blue-darken-3">EMPLOYEE ID: {{ items?.TEC_CPHREC_EMPNO }}</h1>
                </div>
            </template>

            <template #text>
                <v-virtual-scroll :items="[1]" height="550" item-height="auto" class="overflow-x-hidden">
                    <v-row>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Loader
                                    Input</span>: {{
                                        items?.TEC_CPHREC_LOADINP }}</p>
                        </v-col>
                        <v-col cols="auto" md="6" v-if="items?.TEC_CPHREC_LOADINP === 'Use'">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Pitch Setting:
                                </span>{{
                                    items?.TEC_CPHREC_LOADINPPITCH }}</p>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Stacker</span>:
                                {{
                                    items?.TEC_CPHREC_STACK }}</p>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Traceability
                                    Input</span>: {{
                                        items?.TEC_CPHREC_TRACEINP }}</p>
                        </v-col>

                    </v-row>
                    <v-row>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">PCB Cleaning
                                </span>: {{
                                    items?.TEC_CPHREC_PCBCLEAN }}</p>
                        </v-col>
                        <v-col cols="auto" md="6" v-if="items?.TEC_CPHREC_PCBCLEAN === 'Use'">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Traceability
                                    Input</span>: {{
                                        items?.TEC_CPHREC_PCBCLNFUNC }}</p>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Glue (M/C #1)
                                </span>: {{
                                    items?.TEC_CPHREC_GLUE }}</p>
                        </v-col>
                        <v-col cols="auto" md="6" v-if="items?.TEC_CPHREC_GLUE === 'Use'">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Program name
                                </span>: {{
                                    items?.TEC_CPHREC_GLUEPROG }}</p>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Glue number
                                </span>: {{
                                    items?.TEC_CPHREC_GLUENUM }}</p>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Head Unit
                                </span>: {{
                                    items?.TEC_CPHREC_GLUEHUNIT }}</p>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6" v-if="items?.TEC_CPHREC_GLUESTDOK == 'OK'">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Backup pin
                                    standard no.
                                </span>: {{
                                    items?.TEC_CPHREC_GLUESTDOK }}</p>
                        </v-col>
                        <v-col cols="auto" md="6" v-else>
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Backup pin
                                    standard no.
                                </span>: {{
                                    items?.TEC_CPHREC_GLUESTDNOT }}</p>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Glue (M/C #2)
                                </span>: {{
                                    items?.TEC_CPHREC_GLUESND }}</p>
                        </v-col>
                        <v-col cols="auto" md="6" v-if="items?.TEC_CPHREC_GLUE === 'Use'">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Program name
                                </span>: {{
                                    items?.TEC_CPHREC_GLUESNDPROG }}</p>
                        </v-col>
                    </v-row>
                    <v-row v-if="items?.TEC_CPHREC_GLUE === 'Use'">
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Glue number
                                </span>: {{
                                    items?.TEC_CPHREC_GLUESNDNUM }}</p>
                        </v-col>
                    </v-row>
                    <v-row v-if="items?.TEC_CPHREC_GLUE === 'Use'">
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Head Unit
                                </span>: {{
                                    items?.TEC_CPHREC_GLUESNDHUNIT }}</p>
                        </v-col>
                    </v-row>
                    <v-row v-if="items?.TEC_CPHREC_GLUE === 'Use'">
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6" v-if="items?.TEC_CPHREC_GLUESNDOK == 'OK'">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Backup pin
                                    standard no.
                                </span>: {{
                                    items?.TEC_CPHREC_GLUESTDOK }}</p>
                        </v-col>
                        <v-col cols="auto" md="6" v-else>
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Backup pin
                                    standard no.
                                </span>: {{
                                    items?.TEC_CPHREC_GLUESNDNOT }}</p>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Mounter (M/C
                                    #1)
                                </span>: {{
                                    items?.TEC_CPHREC_MNTF }}</p>
                        </v-col>
                        <v-col cols="auto" md="6" v-if="items?.TEC_CPHREC_MNTF === 'Use'">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Program name
                                </span>: {{
                                    items?.TEC_CPHREC_MNTFPROG }}</p>
                        </v-col>
                    </v-row>
                    <v-row v-if="items?.TEC_CPHREC_MNTF === 'Use'">
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Nozzle setting
                                </span>: {{
                                    items?.TEC_CPHREC_MNTFNOZ }}</p>
                        </v-col>
                    </v-row>
                    <v-row v-if="items?.TEC_CPHREC_MNTF === 'Use'">
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Support PCB
                                </span>: {{
                                    items?.TEC_CPHREC_MNTFSUPT }}</p>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Mounter (M/C
                                    #2)
                                </span>: {{
                                    items?.TEC_CPHREC_MNTSN }}</p>
                        </v-col>
                        <v-col cols="auto" md="6" v-if="items?.TEC_CPHREC_MNTSN === 'Use'">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Program name
                                </span>: {{
                                    items?.TEC_CPHREC_MNTFPROG }}</p>
                        </v-col>
                    </v-row>
                    <v-row v-if="items?.TEC_CPHREC_MNTSN === 'Use'">
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Nozzle setting
                                </span>: {{
                                    items?.TEC_CPHREC_MNTSNNOZ }}</p>
                        </v-col>
                    </v-row>
                    <v-row v-if="items?.TEC_CPHREC_MNTSN === 'Use'">
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Nozzle setting
                                </span>: {{
                                    items?.TEC_CPHREC_MNTSNSUPT }}</p>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Mounter (M/C
                                    #2)
                                </span>: {{
                                    items?.TEC_CPHREC_MNTTR }}</p>
                        </v-col>
                        <v-col cols="auto" md="6" v-if="items?.TEC_CPHREC_MNTTR === 'Use'">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Program name
                                </span>: {{
                                    items?.TEC_CPHREC_MNTTRPROG }}</p>
                        </v-col>
                    </v-row>
                    <v-row v-if="items?.TEC_CPHREC_MNTTR === 'Use'">
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Nozzle setting
                                </span>: {{
                                    items?.TEC_CPHREC_MNTTRNOZ }}</p>
                        </v-col>
                    </v-row>
                    <v-row v-if="items?.TEC_CPHREC_MNTTR === 'Use'">
                        <v-col cols="auto" md="6"></v-col>
                        <v-col cols="auto" md="6">
                            <p class="border pa-2 rounded-tl-md rounded-bl-md"><span
                                    class="bg-blue-200 pa-2 rounded-tl-md rounded-bl-md font-weight-bold">Nozzle setting
                                </span>: {{
                                    items?.TEC_CPHREC_MNTTRSUPT }}</p>
                        </v-col>
                    </v-row>

                </v-virtual-scroll>

            </template>
            <template v-slot:actions>
                <v-btn class="mb-2 ms-auto" text="Close" @click="dialog_CP = false"></v-btn>
            </template>
        </v-card>
    </v-dialog>
</template>
<script lang="ts" setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import dayjs from "dayjs";

definePageMeta({
    layout: 'custom'
})

/**
 * TODO: สร้างตัวแปรเพื่อรับค่า api และ v-model
 */
const search = ref<string>("")
const search_rf = ref<string>("")
const dialog_CP = ref<boolean>(false)

const all_data = ref<any>([])
const all_data_rf = ref<any>([])

interface TechCPItem {
    TEC_CP_HREC_ID: string | number

}
const items = ref<TechCPItem | null>(null)

/**
 * TODO: สร้างฟังก์ชันรับค่าจาก api 
 */

const GetAllData = async () => {
    try {
        const res = await axios.get('http://172.22.64.11/49_modelchange/49_mdlchn_api/api/get/alldata')
        console.log(res.data)
        all_data.value = res.data.cp
        all_data_rf.value = res.data.rf

    } catch (error) {
        console.log(error)
    }
}

/**
 * TODO: สร้างฟังก์ชัน Event DOM
 * 
 */

const dateFormat = (date: string) => {
    return dayjs(date).format('DD/MM/YYYY')
}



// ✅ ฟังก์ชันเปิด dialog
const dialog_cp = (item: TechCPItem) => {
    items.value = item
    dialog_CP.value = true
    console.log(items.value)
}
onMounted(() => {
    GetAllData();
})

</script>