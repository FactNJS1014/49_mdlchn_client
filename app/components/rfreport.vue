<template>
  <!-- Template PDF hidden -->
  <div ref="pdfTemplate" class="hidden pa-2">
    <p class="flex justify-center text-lg font-bold align-center">
      MODEL CHANGE RECORD SMT PROCESS : {{ rfItem?.OPR_HREC_PROCS }}
    </p>
    <div class="flex justify-end p-3 mt-3 mb-3">
      <table class="border border-black border-collapse">
        <thead>
          <tr>
            <th width="120px" class="text-center border border-black px-2 py-2">
              QC
            </th>
            <th width="120px" class="text-center border border-black px-2 py-2">
              LEADER
            </th>
            <th width="120px" class="text-center border border-black px-2 py-2">
              SUB LEADER
            </th>
            <th width="120px" class="text-center border border-black px-2 py-2">
              TECHNICIAN
            </th>
            <th width="120px" class="text-center border border-black px-2 py-2">
              OPERATOR
            </th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td height="45px" class="text-center border border-black">
              {{
                rfItem?.levels[3]?.empapp == 0
                  ? "ยังไม่อนุมัติ"
                  : findUserName(rfItem?.levels[3]?.empapp)
              }}
            </td>
            <td height="45px" class="text-center border border-black">
              {{
                rfItem?.levels[2]?.empapp == 0
                  ? "ยังไม่อนุมัติ"
                  : findUserName(rfItem?.levels[2]?.empapp)
              }}
            </td>
            <td height="45px" class="text-center border border-black">
              {{
                rfItem?.levels[1]?.empapp == 0
                  ? "ยังไม่อนุมัติ"
                  : findUserName(rfItem?.levels[1]?.empapp)
              }}
            </td>
            <td height="45px" class="text-center border border-black">
              {{ findUserName(rfItem?.TEC_CPHREC_EMPNO) }}
            </td>
            <td height="45px" class="text-center border border-black">
              {{ findUserName(rfItem?.OPR_HREC_EMPNO) }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="pa-3 border border-black w-[800px] bg-white mt-3 space-y-2">
      <div class="grid grid-cols-3 gap-4">
        <div><strong>Line:</strong> {{ rfItem?.OPR_HREC_LINE }}</div>
        <div>
          <strong>Date:</strong> {{ dateFormat(rfItem?.OPR_HREC_DATEREC) }}
        </div>
        <div>
          <strong>Document No.:</strong>
          {{ rfItem?.OPR_HREC_ISSUENO.split("-").pop().slice(-3) }}
        </div>
      </div>
      <div class="grid grid-cols-1 gap-4">
        <div class="flex items-center gap-2">
          <strong>Status:</strong>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.OPR_HREC_STATUSMDL === 'Urgent'"
          />
          <span>Urgent</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.OPR_HREC_STATUSMDL === 'Normal'"
          />
          <span>Normal</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.OPR_HREC_STATUSMDL === 'New Line'"
          />
          <span>New Line</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.OPR_HREC_STATUSMDL === 'New model'"
          />
          <span>New model</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.OPR_HREC_STATUSMDL === 'Over Plan'"
          />
          <span>Over Plan</span>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <strong>Current Model Code:</strong> {{ rfItem?.OPR_HREC_CURMDLNM }}
        </div>
        <div>
          <strong>Change Model Code:</strong> {{ rfItem?.OPR_HREC_CHNMDLNM }}
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <strong>WO#:</strong> {{ rfItem?.OPR_HREC_WON_CURRENT }}
          <strong class="ms-3">Lot Size:</strong>
          {{ rfItem?.OPR_HREC_LOTS }} pcs.
          <div class="flex items-center gap-2">
            <strong class="mr-2">Process:</strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.OPR_HREC_PROCS_RF === 'CP'"
            />
            <span>CP</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.OPR_HREC_PROCS_RF === 'RF1'"
            />
            <span>RF1</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.OPR_HREC_PROCS_RF === 'RF2'"
            />
            <span>RF2</span>
          </div>
        </div>
        <div>
          <strong>WO#:</strong> {{ rfItem?.OPR_HREC_WON_CHANGE }}
          <strong class="ms-3">Lot Size:</strong>
          {{ rfItem?.OPR_HREC_LOTS_CHN }} pcs.
          <div class="flex items-center gap-2">
            <strong class="mr-2">Process:</strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.OPR_HREC_PROCS_RF_CHN === 'CP'"
            />
            <span>CP</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.OPR_HREC_PROCS_RF_CHN === 'RF1'"
            />
            <span>RF1</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.OPR_HREC_PROCS_RF_CHN === 'RF2'"
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
            :checked="rfItem?.OPR_HREC_CONTECN === 'No Have'"
          />
          <span>No Have</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.OPR_HREC_CONTECN === 'Have'"
          />
          <span>Have</span>

          <div class="ms-3">
            <strong>ECN Number:</strong>
            <span>{{
              rfItem?.OPR_HREC_CONTECN === "No Have"
                ? "ไม่มี"
                : rfItem?.OPR_HREC_HAVECONTECN_NO
            }}</span>
            <strong class="ms-3">ECN REV:</strong>
            <span>{{
              rfItem?.OPR_HREC_CONTECN === "No Have"
                ? "ไม่มี"
                : rfItem?.OPR_HREC_HAVECONTECN_REV
            }}</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div><strong>Program name:</strong> {{ rfItem?.OPR_HREC_PRGMNM }}</div>
        <div><strong>REV.:</strong> {{ rfItem?.OPR_HREC_PRGMREV }}</div>
      </div>
    </div>

    <div
      class="grid grid-cols-2 border border-gray-400 px-3 py-4 avoid-break-inside"
    >
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>1) Loader Input: </strong>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.TEC_RFHREC_LOADINP === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.TEC_RFHREC_LOADINP === 'Not Use'"
          />
          <span>Not Use</span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>Pitching: </strong>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.TEC_RFHREC_LOADINPPITCH === '10 mm.'"
          />
          <span>10 mm.</span>

          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.TEC_RFHREC_LOADINPPITCH === '20 mm.'"
          />
          <span>20 mm.</span>

          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.TEC_RFHREC_LOADINPPITCH === '30 mm.'"
          />
          <span>30 mm.</span>
        </div>
      </div>
    </div>

    <div
      class="grid grid-cols-1 avoid-break-inside px-3 py-4 border border-black"
    >
      <div class="flex items-center gap-2">
        <strong>2) Stacker: </strong>
        <input
          type="checkbox"
          class="w-4 h-4 mt-3"
          :checked="rfItem?.TEC_RFHREC_STACK === 'Use'"
        />
        <span>Use</span>
        <input
          type="checkbox"
          class="w-4 h-4 mt-3"
          :checked="rfItem?.TEC_RFHREC_STACK === 'Not Use'"
        />
        <span>Not Use</span>
      </div>
    </div>
    <div
      class="grid grid-cols-1 avoid-break-inside px-3 py-4 border border-black"
    >
      <div class="flex items-center gap-2">
        <strong>3) Traceabiliy Input: </strong>
        <input
          type="checkbox"
          class="w-4 h-4 mt-3"
          :checked="rfItem?.TEC_RFHREC_TRACEINP === 'Use'"
        />
        <span>Use</span>
        <input
          type="checkbox"
          class="w-4 h-4 mt-3"
          :checked="rfItem?.TEC_RFHREC_TRACEINP === 'Not Use'"
        />
        <span>Not Use</span>
      </div>
    </div>
    <div
      class="grid grid-cols-2 avoid-break-inside px-3 py-4 border border-black"
    >
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>4) PCB Cleaning: </strong>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.TEC_RFHREC_PCBCLEAN === 'Use'"
          />
          <span>Use</span>
          <input
            type="checkbox"
            class="w-4 h-4 mt-3"
            :checked="rfItem?.TEC_RFHREC_PCBCLEAN === 'Not Use'"
          />
          <span>Not Use</span>
        </div>
      </div>
      <div class="flex flex-col">
        <div class="flex items-center gap-2">
          <strong>Function: </strong>

          <span>{{ rfItem?.TEC_RFHREC_PCBCLNFUNC }}</span>
          <strong>ETC: </strong>
          <span>{{ rfItem?.TEC_RFHREC_PCBLNETC }}</span>
        </div>
      </div>
    </div>

    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>5) Printer: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_PRINT === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_PRINT === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Program name: </strong>

            <span>{{ rfItem?.TEC_RFHREC_PRINTPROG }}</span>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Metal Mask: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_PRINTMM === 'Referent PCB Number'"
            />
            <span>Referent PCB Number</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_PRINTREF === 'REF'"
            />
            <span>REF#</span>
            <span class="ms-2">{{
              rfItem?.TEC_RFHREC_PRINTMM === "REF"
                ? rfItem?.TEC_RFHREC_PRINTREF
                : ""
            }}</span>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Squeegee: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_SQUE === 'Good condition'"
            />
            <span>Good condition</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Support PCB: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_PRINTSUPT === 'Backup plate'"
            />
            <span>Backup plate</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_PRINTSUPT === 'Backup pin'"
            />
            <span>Backup pin</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Solder plate number: </strong>

            <span>{{ rfItem?.TEC_RFHREC_PRINTSOLDER }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>6) Glue: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_GLUE === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_GLUE === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Program name: </strong>

            <span>{{ rfItem?.TEC_RFHREC_GLUEPROG }}</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Glue Number: </strong>
            <span>{{ rfItem?.TEC_RFHREC_GLUENUM }}</span>
          </div>
        </div>
      </div>
    </div>

    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>7) Solder plate inspection: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_SOLDERINSP === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_SOLDERINSP === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Program name: </strong>
            <span>{{ rfItem?.TEC_RFHREC_SOLDERPROG }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>8) Mounter (M/C #1): </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTF === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTF === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Program name: </strong>
            <span>{{ rfItem?.TEC_RFHREC_MNTFPROG }}</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Nozzle Setting: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFNOZ === 'Automatic'"
            />
            <span>Automatic</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFNOZ === 'Manual'"
            />
            <span>Manual</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Support PCB: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFSUPT === 'Pin'"
            />
            <span>Pin</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFSUPT === 'Magnet'"
            />
            <span>Magnet</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFSUPT === 'Sponge'"
            />
            <span>Sponge</span>
          </div>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>9) Mounter (M/C #2): </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTSN === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTSN === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Program name: </strong>
            <span>{{ rfItem?.TEC_RFHREC_MNTSNPROG }}</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Nozzle Setting: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTSNNOZ === 'Automatic'"
            />
            <span>Automatic</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTSNNOZ === 'Manual'"
            />
            <span>Manual</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Support PCB: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTSNSUPT === 'Pin'"
            />
            <span>Pin</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTSNSUPT === 'Magnet'"
            />
            <span>Magnet</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTSNSUPT === 'Sponge'"
            />
            <span>Sponge</span>
          </div>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>10) Mounter (M/C #3): </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTTR === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTTR === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Program name: </strong>
            <span>{{ rfItem?.TEC_RFHREC_MNTTRPROG }}</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Nozzle Setting: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTTRNOZ === 'Automatic'"
            />
            <span>Automatic</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTTRNOZ === 'Manual'"
            />
            <span>Manual</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Support PCB: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTTRSUPT === 'Pin'"
            />
            <span>Pin</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTTRSUPT === 'Magnet'"
            />
            <span>Magnet</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTTRSUPT === 'Sponge'"
            />
            <span>Sponge</span>
          </div>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>11) Mounter (M/C #4): </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFO === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFO === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Program name: </strong>
            <span>{{ rfItem?.TEC_RFHREC_MNTFOPROG }}</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Nozzle Setting: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFONOZ === 'Automatic'"
            />
            <span>Automatic</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFONOZ === 'Manual'"
            />
            <span>Manual</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Support PCB: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFOSUPT === 'Pin'"
            />
            <span>Pin</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFOSUPT === 'Magnet'"
            />
            <span>Magnet</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTFOSUPT === 'Sponge'"
            />
            <span>Sponge</span>
          </div>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>12) Mounter Inspector: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTINSP === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_MNTINSP === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Program name: </strong>
            <span>{{ rfItem?.TEC_RFHREC_MNTINSPPROG }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>13) Reflow: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_REFLOW === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_REFLOW === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Program name: </strong>
            <span>{{ rfItem?.TEC_RFHREC_REFLPROG }}</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Oxygen: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_REFLOXYGEN === 'Use'"
            />
            <span>Use</span>
            <span>{{
              rfItem?.TEC_RFHREC_REFLOXYGEN === "Use"
                ? rfItem?.TEC_RFHREC_REFLOO
                : ""
            }}</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3 ms-3"
              :checked="rfItem?.TEC_RFHREC_REFLOXYGEN === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> PCB Supporter: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_REFLPCBSUPT === 'Use'"
            />
            <span>Use</span>

            <input
              type="checkbox"
              class="w-4 h-4 mt-3 ms-3"
              :checked="rfItem?.TEC_RFHREC_REFLPCBSUPT === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="flex flex-col"></div>

        <div class="flex flex-col">
          <strong>Temperature profile:</strong>

          <table class="min-w-max text-sm table-auto">
            <thead>
              <tr>
                <th class="p-2 text-left w-24 break-words">Channel</th>
                <th class="p-2 text-left break-words">TOP Side</th>
                <th class="p-2 text-left break-words">BOTTOM Side</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td class="p-2 break-words">CH-1</td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_TOP_TEMPCH1 }}
                </td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_BTM_TEMPCH1 }}
                </td>
              </tr>
              <tr>
                <td class="p-2 break-words">CH-2</td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_TOP_TEMPCH2 }}
                </td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_BTM_TEMPCH2 }}
                </td>
              </tr>
              <tr>
                <td class="p-2 break-words">CH-3</td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_TOP_TEMPCH3 }}
                </td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_BTM_TEMPCH3 }}
                </td>
              </tr>
              <tr>
                <td class="p-2 break-words">CH-4</td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_TOP_TEMPCH4 }}
                </td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_BTM_TEMPCH4 }}
                </td>
              </tr>
              <tr>
                <td class="p-2 break-words">CH-5</td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_TOP_TEMPCH5 }}
                </td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_BTM_TEMPCH5 }}
                </td>
              </tr>
              <tr>
                <td class="p-2 break-words">CH-6</td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_TOP_TEMPCH6 }}
                </td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_BTM_TEMPCH6 }}
                </td>
              </tr>
              <tr>
                <td class="p-2 break-words">CH-7</td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_TOP_TEMPCH7 }}
                </td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_BTM_TEMPCH7 }}
                </td>
              </tr>
              <tr>
                <td class="p-2 break-words">CH-8</td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_TOP_TEMPCH8 }}
                </td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_BTM_TEMPCH8 }}
                </td>
              </tr>
              <tr>
                <td class="p-2 break-words">CH-9</td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_TOP_TEMPCH9 }}
                </td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_BTM_TEMPCH9 }}
                </td>
              </tr>
              <tr>
                <td class="p-2 break-words">CH-10</td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_TOP_TEMPCH10 }}
                </td>
                <td class="p-2 break-words">
                  {{ rfItem?.TEC_RFHREC_BTM_TEMPCH10 }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>14) PCB Cooling: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_PCBCOOL === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_PCBCOOL === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>15) Auto Optic Inspection: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_AUTO === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_AUTO === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Program name: </strong>
            <span>{{ rfItem?.TEC_RFHREC_AUTOPROG }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>16) NG Stocker: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_NGSTCK === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_NGSTCK === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Pitch setting: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_NGSTCKPITCH === '10 mm.'"
            />
            <span>10 mm.</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_NGSTCKPITCH === '20 mm.'"
            />
            <span>20 mm.</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_NGSTCKPITCH === '30 mm.'"
            />
            <span>30 mm.</span>
          </div>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>17) Traceability Input: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_TRACE === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_TRACE === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>
      </div>
    </div>
    <div class="border border-black px-3 py-4 avoid-break-inside">
      <div class="grid grid-cols-2">
        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong>18) Unloader Input: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_UNLOADER === 'Use'"
            />
            <span>Use</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_UNLOADER === 'Not Use'"
            />
            <span>Not Use</span>
          </div>
        </div>

        <div class="flex flex-col">
          <div class="flex items-center gap-2">
            <strong> Pitch setting: </strong>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_UNLOADERPITCH === '10 mm.'"
            />
            <span>10 mm.</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_UNLOADERPITCH === '20 mm.'"
            />
            <span>20 mm.</span>
            <input
              type="checkbox"
              class="w-4 h-4 mt-3"
              :checked="rfItem?.TEC_RFHREC_UNLOADERPITCH === '30 mm.'"
            />
            <span>30 mm.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref, watch, nextTick, defineProps } from "vue";
import axios from "axios";
import dayjs from "dayjs";

const props = defineProps<{
  rfItem: any;
}>();

const pdfTemplate = ref<HTMLElement | null>(null);
const employees = ref<string[]>([]);

const dateFormat = (date: string) => dayjs(date).format("DD/MM/YYYY");

// Watch เมื่อ props.rfItem เปลี่ยน -> สร้าง PDF ทันที
watch(
  () => props.rfItem,
  async (newVal) => {
    if (!newVal) return;
    await nextTick();
    generatePdf();
  },
  { immediate: true }
);

const GetUsersWeb = async () => {
  const res = await axios.get(
    "http://172.22.64.11/49_modelchange/49_mdlchn_api/api/users"
  );
  // console.log(res.data)
  employees.value = res.data.ALL;
};

const findUserName = (empId: string) => {
  const emp = employees.value.find((e) => e.MUSR_ID == empId);
  return emp ? emp.MUSR_NAME : "ไม่พบชื่อ";
};

onMounted(async () => {
  await GetUsersWeb();
});

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
        if (
          elementTopPx < pageBreakPointPx &&
          elementBottomPx > pageBreakPointPx
        ) {
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

        if (
          elementHeightPx > remainingSpacePx ||
          remainingSpacePx < SAFETY_MARGIN_PX
        ) {
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
