<template>
  <!-- Template PDF hidden -->
  <div ref="pdfTemplate" class="hidden pa-2">
    <p class="flex justify-center text-lg font-bold align-center">
      MODEL CHANGE RECORD SMT PROCESS : {{ dataItem?.OPR_HREC_PROCS }}
    </p>
    <div class="pa-3 border border-black w-[800px] bg-white mt-3 space-y-2">
      <div class="grid grid-cols-3 gap-4">
        <div><strong>Line:</strong> {{ dataItem?.OPR_HREC_LINE }}</div>
        <div><strong>Date:</strong> {{ dateFormat(dataItem?.OPR_HREC_DATEREC) }}</div>
<<<<<<< HEAD
        <div>
          <strong>Document No.:</strong>
          {{ dataItem?.OPR_HREC_ISSUENO.split("-").pop().slice(-3) }}
        </div>
=======
        <div><strong>Document No.:</strong> {{ dataItem?.OPR_HREC_ISSUENO }}</div>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
      </div>
      <div class="grid grid-cols-1 gap-4">
        <div class="flex items-center gap-2">
          <strong>Status:</strong>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.OPR_HREC_STATUSMDL === 'Urgent'"
          />
          <span>Urgent</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.OPR_HREC_STATUSMDL === 'Normal'"
          />
          <span>Normal</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.OPR_HREC_STATUSMDL === 'New Line'"
          />
          <span>New Line</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.OPR_HREC_STATUSMDL === 'New model'"
          />
          <span>New model</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.OPR_HREC_STATUSMDL === 'Over Plan'"
          />
          <span>Over Plan</span>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div><strong>Current Model Code:</strong> {{ dataItem?.OPR_HREC_CURMDLNM }}</div>
        <div><strong>Change Model Code:</strong> {{ dataItem?.OPR_HREC_CHNMDLNM }}</div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <strong>WO#:</strong> {{ dataItem?.OPR_HREC_WON_CURRENT }}
          <strong class="ms-3">Lot Size:</strong> {{ dataItem?.OPR_HREC_LOTS }} pcs.
          <div class="flex items-center gap-2">
            <strong class="mr-2">Process:</strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="dataItem?.OPR_HREC_PROCS_RF === 'CP'"
            />
            <span>CP</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="dataItem?.OPR_HREC_PROCS_RF === 'RF1'"
            />
            <span>RF1</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="dataItem?.OPR_HREC_PROCS_RF === 'RF2'"
            />
            <span>RF2</span>
          </div>
        </div>
        <div>
          <strong>WO#:</strong> {{ dataItem?.OPR_HREC_WON_CHANGE }}
          <strong class="ms-3">Lot Size:</strong> {{ dataItem?.OPR_HREC_LOTS_CHN }} pcs.
          <div class="flex items-center gap-2">
            <strong class="mr-2">Process:</strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="dataItem?.OPR_HREC_PROCS_RF_CHN === 'CP'"
            />
            <span>CP</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="dataItem?.OPR_HREC_PROCS_RF_CHN === 'RF1'"
            />
            <span>RF1</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="dataItem?.OPR_HREC_PROCS_RF_CHN === 'RF2'"
            />
            <span>RF2</span>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-4">
        <div class="flex items-center gap-2">
          <strong>ECN Control:</strong>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.OPR_HREC_CONTECN === 'No Have'"
          />
          <span>No Have</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.OPR_HREC_CONTECN === 'Have'"
          />
          <span>Have</span>

          <div class="ms-3">
            <strong>ECN Number:</strong>
            <span>{{
              dataItem?.OPR_HREC_CONTECN === "No Have"
                ? "ไม่มี"
                : dataItem?.OPR_HREC_HAVECONTECN_NO
            }}</span>
            <strong class="ms-3">ECN REV:</strong>
            <span>{{
              dataItem?.OPR_HREC_CONTECN === "No Have"
                ? "ไม่มี"
                : dataItem?.OPR_HREC_HAVECONTECN_REV
            }}</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div><strong>Program name:</strong> {{ dataItem?.OPR_HREC_PRGMNM }}</div>
        <div><strong>REV.:</strong> {{ dataItem?.OPR_HREC_PRGMREV }}</div>
      </div>
    </div>

    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>1) Loader Input: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_LOADINP === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_LOADINP === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_LOADINP === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_LOADINP === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>Pitching: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_LOADINPPITCH === '10 mm.'"
          />
          <span>10 mm.</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_LOADINPPITCH === '20 mm.'"
          />
          <span>20 mm.</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_LOADINPPITCH === '30 mm.'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_LOADINPPITCH === '10 mm.'" />
          <span>10 mm.</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_LOADINPPITCH === '20 mm.'" />
          <span>20 mm.</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_LOADINPPITCH === '30 mm.'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>30 mm.</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-1">
      <div class="flex items-center gap-2">
        <strong>2) Stacker: </strong>
<<<<<<< HEAD
        <input
          type="checkbox"
          class="w-4 h-4 mt-3"
          :checked="dataItem?.TEC_RFHREC_STACK === 'Use'"
        />
        <span>Use</span>
        <input
          type="checkbox"
          class="w-4 h-4 mt-3"
          :checked="dataItem?.TEC_RFHREC_STACK === 'Not Use'"
        />
=======
        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_STACK === 'Use'" />
        <span>Use</span>
        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_STACK === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        <span>Not Use</span>
      </div>
    </div>
    <div class="grid grid-cols-1">
      <div class="flex items-center gap-2">
        <strong>3) Traceabiliy Input: </strong>
<<<<<<< HEAD
        <input
          type="checkbox"
          class="w-4 h-4 mt-3"
          :checked="dataItem?.TEC_RFHREC_TRACEINP === 'Use'"
        />
        <span>Use</span>
        <input
          type="checkbox"
          class="w-4 h-4 mt-3"
          :checked="dataItem?.TEC_RFHREC_TRACEINP === 'Not Use'"
        />
=======
        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_TRACEINP === 'Use'" />
        <span>Use</span>
        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_TRACEINP === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        <span>Not Use</span>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>4) PCB Cleaning: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PCBCLEAN === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PCBCLEAN === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PCBCLEAN === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PCBCLEAN === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>Function: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PCBCLNFUNC === 'Air blow'"
          />
          <span>Air blow</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PCBCLNFUNC === 'Sticky'"
          />
          <span>Sticky</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PCBCLNFUNC === 'lonizer'"
          />
          <span>lonizer</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PCBCLNFUNC === 'etc'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PCBCLNFUNC === 'Air blow'" />
          <span>Air blow</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PCBCLNFUNC === 'Sticky'" />
          <span>Sticky</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PCBCLNFUNC === 'lonizer'" />
          <span>lonizer</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PCBCLNFUNC === 'etc'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Etc.</span>
        </div>
        <span>{{
          dataItem?.TEC_RFHREC_PCBCLNFUNC === "etc"
            ? dataItem?.TEC_RFHREC_PCBLNETC_DTL
            : ""
        }}</span>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>5) Printer: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PRINT === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PRINT === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PRINT === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PRINT === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Program name: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PRINTPROG === dataItem?.OPR_HREC_PRGMNM"
          />
          <span>{{ dataItem?.OPR_HREC_PRGMNM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PRINTPROG ===
            'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Metal Mask: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PRINTMM === 'Referent PCB Number'"
          />
          <span>Referent PCB Number</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PRINTREF === 'REF'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PRINTMM === 'Referent PCB Number'" />
          <span>Referent PCB Number</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PRINTREF === 'REF'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>REF#</span>
          <span class="ms-2">{{
            dataItem?.TEC_RFHREC_PRINTMM === "REF" ? dataItem?.TEC_RFHREC_PRINTREF : ""
          }}</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Squeegee: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_SQUE === 'Good condition'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_SQUE === 'Good condition'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Good condition</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Support PCB: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PRINTSUPT === 'Backup plate'"
          />
          <span>Backup plate</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PRINTSUPT === 'Backup pin'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PRINTSUPT === 'Backup plate'" />
          <span>Backup plate</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PRINTSUPT === 'Backup pin'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Backup pin</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Solder plate number: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PRINTSOLDER === dataItem?.OPR_HREC_PRGMNM"
          />
          <span>{{ dataItem?.OPR_HREC_PRGMNM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PRINTSOLDER ===
            'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>6) Glue: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_GLUE === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_GLUE === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_GLUE === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_GLUE === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Program name: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_GLUEPROG === dataItem?.OPR_HREC_PRGMNM"
          />
          <span>{{ dataItem?.OPR_HREC_PRGMNM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_GLUEPROG === 'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Glue Number: </strong>
<<<<<<< HEAD
          <span>{{ dataItem?.TEC_RFHREC_GLUENUM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_GLUENUM === 'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>7) Solder plate inspection: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_SOLDERINSP === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_SOLDERINSP === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_SOLDERINSP === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_SOLDERINSP === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Program name: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_SOLDERPROG === dataItem?.OPR_HREC_PRGMNM"
          />
          <span>{{ dataItem?.OPR_HREC_PRGMNM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_SOLDERPROG ===
            'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>

    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>8) Mounter (M/C #1): </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTF === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTF === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTF === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTF === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Program name: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFPROG === dataItem?.OPR_HREC_PRGMNM"
          />
          <span>{{ dataItem?.OPR_HREC_PRGMNM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFPROG === 'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Nozzle Setting: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFNOZ === 'Automatic'"
          />
          <span>Automatic</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFNOZ === 'Manual'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFNOZ === 'Automatic'" />
          <span>Automatic</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFNNOZ === 'Manual'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Manual</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Support PCB: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFSUPT === 'Pin'"
          />
          <span>Pin</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFSUPT === 'Magnet'"
          />
          <span>Magnet</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFSUPT === 'Sponge'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFSUPT === 'Pin'" />
          <span>Pin</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFSUPT === 'Magnet'" />
          <span>Magnet</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFSUPT === 'Sponge'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Sponge</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>9) Mounter (M/C #2): </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTSN === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTSN === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTSN === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTSN === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Program name: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTSNPROG === dataItem?.OPR_HREC_PRGMNM"
          />
          <span>{{ dataItem?.OPR_HREC_PRGMNM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTSNPROG ===
            'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Nozzle Setting: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTSNNOZ === 'Automatic'"
          />
          <span>Automatic</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTSNNOZ === 'Manual'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTSNNOZ === 'Automatic'" />
          <span>Automatic</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTSNNOZ === 'Manual'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Manual</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Support PCB: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTSNSUPT === 'Pin'"
          />
          <span>Pin</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTSNSUPT === 'Magnet'"
          />
          <span>Magnet</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTSNSUPT === 'Sponge'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTSNSUPT === 'Pin'" />
          <span>Pin</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTSNSUPT === 'Magnet'" />
          <span>Magnet</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTSNSUPT === 'Sponge'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Sponge</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>10) Mounter (M/C #3): </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTTR === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTTR === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTTR === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTTR === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Program name: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTTRPROG === dataItem?.OPR_HREC_PRGMNM"
          />
          <span>{{ dataItem?.OPR_HREC_PRGMNM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTTRPROG ===
            'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Nozzle Setting: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTTRNOZ === 'Automatic'"
          />
          <span>Automatic</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTTRNOZ === 'Manual'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTTRNOZ === 'Automatic'" />
          <span>Automatic</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTTRNOZ === 'Manual'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Manual</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Support PCB: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTTRSUPT === 'Pin'"
          />
          <span>Pin</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTTRSUPT === 'Magnet'"
          />
          <span>Magnet</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTTRSUPT === 'Sponge'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTTRSUPT === 'Pin'" />
          <span>Pin</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTTRSUPT === 'Magnet'" />
          <span>Magnet</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTTRSUPT === 'Sponge'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Sponge</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>11) Mounter (M/C #4): </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFO === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFO === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFO === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFO === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Program name: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFOPROG === dataItem?.OPR_HREC_PRGMNM"
          />
          <span>{{ dataItem?.OPR_HREC_PRGMNM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFOPROG ===
            'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Nozzle Setting: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFONOZ === 'Automatic'"
          />
          <span>Automatic</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFONOZ === 'Manual'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFONOZ === 'Automatic'" />
          <span>Automatic</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFONOZ === 'Manual'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Manual</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Support PCB: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFOSUPT === 'Pin'"
          />
          <span>Pin</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFOSUPT === 'Magnet'"
          />
          <span>Magnet</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTFOSUPT === 'Sponge'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFOSUPT === 'Pin'" />
          <span>Pin</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFOSUPT === 'Magnet'" />
          <span>Magnet</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTFOSUPT === 'Sponge'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Sponge</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>12) Mounter Inspector: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTINSP === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTINSP === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTINSP === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTINSP === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Program name: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_MNTINSPPROG === dataItem?.OPR_HREC_PRGMNM"
          />
          <span>{{ dataItem?.OPR_HREC_PRGMNM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_MNTINSPPROG ===
            'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>13) Reflow: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_REFLOW === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_REFLOW === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_REFLOW === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_REFLOW === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Program name: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_REFLPROG === dataItem?.OPR_HREC_PRGMNM"
          />
          <span>{{ dataItem?.OPR_HREC_PRGMNM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_REFLPROG === 'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Oxygen: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_REFLOXYGEN === 'Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_REFLOXYGEN === 'Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Use</span>
          <span>{{
            dataItem?.TEC_RFHREC_REFLOXYGEN === "Use" ? dataItem?.TEC_RFHREC_REFLOO : ""
          }}</span>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3 ms-3"
            :checked="dataItem?.TEC_RFHREC_REFLOXYGEN === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3 ms-3" :checked="dataItem?.TEC_RFHREC_REFLOXYGEN === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> PCB Supporter: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_REFLPCBSUPT === 'Use'"
          />
          <span>Use</span>

          <input
            type="checkbox"
            class="w-4 h-4 mt-3 ms-3"
            :checked="dataItem?.TEC_RFHREC_REFLPCBSUPT === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_REFLPCBSUPT === 'Use'" />
          <span>Use</span>

          <input type="checkbox" class="w-4 h-4 mt-3 ms-3" :checked="dataItem?.TEC_RFHREC_REFLPCBSUPT === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col"></div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Temperature profile: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_REFLTEMP === 'Pass'"
          />
          <span>Use</span>

          <input
            type="checkbox"
            class="w-4 h-4 mt-3 ms-3"
            :checked="dataItem?.TEC_RFHREC_REFLTEMP === 'No pass'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_REFLTEMP === 'Pass'" />
          <span>Use</span>

          <input type="checkbox" class="w-4 h-4 mt-3 ms-3" :checked="dataItem?.TEC_RFHREC_REFLTEMP === 'No pass'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>14) PCB Cooling: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PCBCOOL === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_PCBCOOL === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PCBCOOL === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_PCBCOOL === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>15) Auto Optic Inspection: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_AUTO === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_AUTO === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_AUTO === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_AUTO === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Program name: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_AUTOPROG === dataItem?.OPR_HREC_PRGMNM"
          />
          <span>{{ dataItem?.OPR_HREC_PRGMNM }}</span>
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_AUTOPROG === 'Referent Assembly chart part list for AM'
            " />
          <span>Referent Assembly chart part list for AM</span>
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
        </div>
      </div>
    </div>

    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>16) NG Stocker: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_NGSTCK === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_NGSTCK === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_NGSTCK === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_NGSTCK === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Pitch setting: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_NGSTCKPITCH === '10 mm.'"
          />
          <span>10 mm.</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_NGSTCKPITCH === '20 mm.'"
          />
          <span>20 mm.</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_NGSTCKPITCH === '30 mm.'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_NGSTCKPITCH === '10 mm.'" />
          <span>10 mm.</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_NGSTCKPITCH === '20 mm.'" />
          <span>20 mm.</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_NGSTCKPITCH === '30 mm.'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>30 mm.</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>17) Traceability Input: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_TRACE === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_TRACE === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_TRACE === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_TRACE === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>18) Unloader Input: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_UNLOADER === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_UNLOADER === 'Not Use'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_UNLOADER === 'Use'" />
          <span>Use</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_UNLOADER === 'Not Use'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong> Pitch setting: </strong>
<<<<<<< HEAD
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_UNLOADERPITCH === '10 mm.'"
          />
          <span>10 mm.</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_UNLOADERPITCH === '20 mm.'"
          />
          <span>20 mm.</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="dataItem?.TEC_RFHREC_UNLOADERPITCH === '30 mm.'"
          />
=======
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_UNLOADERPITCH === '10 mm.'" />
          <span>10 mm.</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_UNLOADERPITCH === '20 mm.'" />
          <span>20 mm.</span>
          <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_RFHREC_UNLOADERPITCH === '30 mm.'" />
>>>>>>> 703d431e6e79d992523794da6a822621f8681a27
          <span>30 mm.</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref, watch, nextTick, defineProps } from "vue";

import dayjs from "dayjs";

const props = defineProps<{
  dataItem: any;
}>();

const pdfTemplate = ref<HTMLElement | null>(null);

const dateFormat = (date: string) => dayjs(date).format("DD/MM/YYYY");

// Watch เมื่อ props.dataItem เปลี่ยน -> สร้าง PDF ทันที
watch(
  () => props.dataItem,
  async (newVal) => {
    if (!newVal) return;
    await nextTick();
    generatePdf();
  },
  { immediate: true }
);

const generatePdf = async () => {
  if (!pdfTemplate.value) return;

  const el = pdfTemplate.value;
  // ตั้งค่า element ให้แสดงผลก่อน render
  el.style.display = "block";
  el.style.position = "absolute";
  el.style.left = "-9999px";
  el.style.top = "0";
  el.style.opacity = "1";
  el.style.fontSize = "12px";
  document.body.appendChild(el);

  await nextTick();

  const html2canvas = (await import("html2canvas")).default;
  const { jsPDF } = await import("jspdf");

  // Render ทั้งหมดเป็น canvas
  const canvas = await html2canvas(el, { scale: 2, useCORS: true });

  const pdf = new jsPDF("p", "mm", "a4");
  const pdfWidth = pdf.internal.pageSize.getWidth();
  const pdfHeight = pdf.internal.pageSize.getHeight();

  const topMargin = 10; // ขอบบน (mm)
  const bottomMargin = 2; // ขอบล่าง (mm)
  const pageContentHeight = pdfHeight - topMargin - bottomMargin; // ความสูงเนื้อหาต่อหน้า (mm)

  const imgWidth = pdfWidth;
  // อัตราส่วนแปลงจาก mm เป็น pixel ของ Canvas (scaleFactor = mm / px)
  const scaleFactor = imgWidth / canvas.width;
  // อัตราส่วนแปลงจาก pixel เป็น mm (pxPerMm = px / mm)
  const pxPerMm = canvas.width / imgWidth;

  // ความสูงที่ถือว่าเป็น 'พื้นที่ปลอดภัย' (ในหน่วย mm)
  // ถ้าองค์ประกอบไม่สามารถแสดงได้ครบในพื้นที่นี้ จะถูกยกไปหน้าใหม่
  const SAFETY_MARGIN_MM = 20;
  const SAFETY_MARGIN_PX = SAFETY_MARGIN_MM * pxPerMm;

  let canvasY = 0; // จุดเริ่มต้น slice จาก canvas (px)
  let firstPage = true;

  // องค์ประกอบลูกทั้งหมดที่ใช้ในการหาจุดแบ่งหน้า
  const elements = Array.from(el.children);

  while (canvasY < canvas.height) {
    if (!firstPage) {
      pdf.addPage();
    }

    // ความสูงสูงสุดที่สามารถ slice ได้สำหรับหน้าปัจจุบัน (ในหน่วย pixel)
    let maxSliceHeightPx = pageContentHeight * pxPerMm;

    // จุดตัดหน้ากระดาษสมมติใน Canvas (pixel)
    let pageBreakPointPx = canvasY + maxSliceHeightPx;

    let finalSliceHeightPx = maxSliceHeightPx;
    let breakFound = false;

    // *** ตรวจสอบและปรับจุดตัดเพื่อป้องกันการตัดครึ่งองค์ประกอบ ***
    for (const element of elements) {
      // ตำแหน่งบนและล่างของ element ใน Canvas (คูณด้วย 2 เนื่องจาก scale: 2)
      const elementTopPx = element.offsetTop * 2;
      const elementBottomPx = (element.offsetTop + element.offsetHeight) * 2;

      // เราสนใจเฉพาะองค์ประกอบที่เริ่มต้นหลังจุดเริ่มต้นของ Canvas Y (canvasY)
      if (elementTopPx >= canvasY) {
        // 1. ตรวจสอบการถูกตัดครึ่ง: ถ้า Element เริ่มต้นในหน้านี้ (elementTopPx < pageBreakPointPx)
        //    แต่ส่วนล่างเลยจุดตัดไป (elementBottomPx > pageBreakPointPx)
        if (elementTopPx < pageBreakPointPx && elementBottomPx > pageBreakPointPx) {
          // ให้คำนวณความสูงใหม่ โดยตัดที่ขอบบนของ Element นี้
          finalSliceHeightPx = elementTopPx - canvasY;
          breakFound = true;
          break;
        }

        // 2. ตรวจสอบ 'พื้นที่เหลือปลอดภัย': ถ้า Element เริ่มต้นในหน้านี้
        //    แต่ความสูงของ Element เกินพื้นที่ว่างที่เหลือ (maxSliceHeightPx - (elementTopPx - canvasY))
        //    หรือส่วนบนของ Element อยู่ใกล้ขอบล่างเกินกว่า SAFETY_MARGIN_PX
        const remainingSpacePx = pageBreakPointPx - elementTopPx;
        const elementHeightPx = elementBottomPx - elementTopPx;

        if (elementHeightPx > remainingSpacePx || remainingSpacePx < SAFETY_MARGIN_PX) {
          // ให้คำนวณความสูงใหม่ โดยตัดที่ขอบบนของ Element นี้ (ยกไปหน้าถัดไป)
          finalSliceHeightPx = elementTopPx - canvasY;
          breakFound = true;
          break;
        }
      }
    }

    // ปรับความสูงสุดท้าย ไม่ให้เกินความสูงที่เหลือของ Canvas
    finalSliceHeightPx = Math.min(finalSliceHeightPx, canvas.height - canvasY);

    // ป้องกันการเกิด slice เป็น 0 (หน้าว่าง) ถ้า finalSliceHeightPx คำนวณออกมาเป็นลบ
    if (finalSliceHeightPx <= 0) {
      finalSliceHeightPx = maxSliceHeightPx; // ใช้ความสูงเต็มหน้าไปเลย
    }

    // --- การสร้าง Canvas ย่อยและวาดรูป (เหมือนเดิม) ---
    const drawHeightInPx = finalSliceHeightPx;
    const pageCanvas = document.createElement("canvas");
    pageCanvas.width = canvas.width;
    pageCanvas.height = drawHeightInPx;
    const ctx = pageCanvas.getContext("2d")!;
    ctx.drawImage(
      canvas,
      0,
      canvasY,
      canvas.width,
      drawHeightInPx,
      0,
      0,
      canvas.width,
      drawHeightInPx
    );

    const imgData = pageCanvas.toDataURL("image/jpeg", 1.0);
    const posY = topMargin;
    const imgDrawHeight = drawHeightInPx * scaleFactor;
    pdf.addImage(imgData, "JPEG", 0, posY, imgWidth, imgDrawHeight);

    // --- อัปเดตตำแหน่ง ---
    canvasY += drawHeightInPx; // เลื่อนจุดเริ่มต้น slice ใน Canvas (px)
    firstPage = false;
  }

  // --- สิ้นสุดการทำงาน (เหมือนเดิม) ---
  window.open(pdf.output("bloburl"), "_blank");
  el.style.display = "none";
};
</script>
