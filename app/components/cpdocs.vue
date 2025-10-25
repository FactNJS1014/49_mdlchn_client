<template>
    <!-- Template PDF hidden -->
    <div ref="pdfTemplate" class="hidden pa-2">
        <p class="flex justify-center text-lg font-bold align-center">
            MODEL CHANGE RECORD SMT PROCESS : {{ dataItem?.OPR_HREC_PROCS }}
        </p>
        <div class="pa-3 border border-black w-[800px] bg-white mt-3 space-y-2">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <strong>Line:</strong> {{ dataItem?.OPR_HREC_LINE }}
                </div>
                <div>
                    <strong>Date:</strong> {{ dateFormat(dataItem?.OPR_HREC_DATEREC) }}
                </div>
                <div>
                    <strong>Document No.:</strong> {{ dataItem?.OPR_HREC_ISSUENO }}
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 ">
                <div class="flex items-center gap-2">
                    <strong>Status:</strong>
                    <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.OPR_HREC_STATUSMDL === 'Urgent'" />
                    <span>Urgent</span>
                    <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.OPR_HREC_STATUSMDL === 'Normal'" />
                    <span>Normal</span>
                    <input type="checkbox" class="w-4 h-4 mt-3"
                        :checked="dataItem?.OPR_HREC_STATUSMDL === 'New Line'" />
                    <span>New Line</span>
                    <input type="checkbox" class="w-4 h-4 mt-3"
                        :checked="dataItem?.OPR_HREC_STATUSMDL === 'New model'" />
                    <span>New model</span>
                    <input type="checkbox" class="w-4 h-4 mt-3"
                        :checked="dataItem?.OPR_HREC_STATUSMDL === 'Over Plan'" />
                    <span>Over Plan</span>
                </div>


            </div>
            <div class="grid grid-cols-2 gap-4 ">
                <div>
                    <strong>Current Model Code:</strong> {{ dataItem?.OPR_HREC_CURMDLNM }}
                </div>
                <div>
                    <strong>Change Model Code:</strong> {{ dataItem?.OPR_HREC_CHNMDLNM }}
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <strong>WO#:</strong> {{ dataItem?.OPR_HREC_WON_CURRENT }}
                    <strong class="ms-3">Lot Size:</strong> {{ dataItem?.OPR_HREC_LOTS }} pcs.


                </div>
                <div>
                    <strong>WO#:</strong> {{ dataItem?.OPR_HREC_WON_CHANGE }}
                    <strong class="ms-3">Lot Size:</strong> {{ dataItem?.OPR_HREC_LOTS_CHN }} pcs.


                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 ">
                <div class="flex items-center gap-2">
                    <strong>ECN Control:</strong>
                    <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.OPR_HREC_CONTECN === 'No Have'" />
                    <span>No Have</span>
                    <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.OPR_HREC_CONTECN === 'Have'" />
                    <span>Have</span>

                    <div class="ms-3">
                        <strong>ECN Number:</strong>
                        <span>{{ dataItem?.OPR_HREC_CONTECN === 'No Have' ? 'ไม่มี' : dataItem?.OPR_HREC_HAVECONTECN_NO
                        }}</span>
                        <strong class="ms-3">ECN REV:</strong>
                        <span>{{ dataItem?.OPR_HREC_CONTECN === 'No Have' ? 'ไม่มี' : dataItem?.OPR_HREC_HAVECONTECN_REV
                        }}</span>
                    </div>


                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 ">
                <div>
                    <strong>Program name:</strong> {{ dataItem?.OPR_HREC_PRGMNM }}
                </div>
                <div>
                    <strong>REV.:</strong> {{ dataItem?.OPR_HREC_PRGMREV }}
                </div>
            </div>

        </div>
        <div class="pa-3 border border-black w-[800px] bg-white mt-3 space-y-2">
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>1) Loader Input: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_LOADINP === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_LOADINP === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>Pitching: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_LOADINPPITCH === '10 mm.'" />
                        <span>10 mm.</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_LOADINPPITCH === '20 mm.'" />
                        <span>20 mm.</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_LOADINPPITCH === '30 mm.'" />
                        <span>30 mm.</span>
                    </div>
                </div>

            </div>
            <div class="grid grid-cols-1">
                <div class="flex items-center gap-2">
                    <strong>2) Stacker: </strong>
                    <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_STACK === 'Use'" />
                    <span>Use</span>
                    <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_STACK === 'Not Use'" />
                    <span>Not Use</span>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="flex items-center gap-2">
                    <strong>3) Traceabiliy Input: </strong>
                    <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_TRACEINP === 'Use'" />
                    <span>Use</span>
                    <input type="checkbox" class="w-4 h-4 mt-3"
                        :checked="dataItem?.TEC_CPHREC_TRACEINP === 'Not Use'" />
                    <span>Not Use</span>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>4) PCB Cleaning: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_PCBCLEAN === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_PCBCLEAN === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>Function: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_PCBCLNFUNC === 'Air blow'" />
                        <span>Air blow</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_PCBCLNFUNC === 'Sticky'" />
                        <span>Sticky</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_PCBCLNFUNC === 'lonizer'" />
                        <span>lonizer</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_PCBCLNFUNC === 'etc'" />
                        <span>Etc.</span>


                    </div>
                    <span>{{ dataItem?.TEC_CPHREC_PCBCLNFUNC === 'etc' ? dataItem?.TEC_CPHREC_PCBLNETC_DTL : ''
                        }}</span>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>5) Glue (M/C #1): </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_GLUE === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUE === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Program name: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUEPROG === 'Referent Assembly chart part list for AM'" />
                        <span>Referent Assembly chart part list for AM</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Glue Number: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUENUM === 'Referent Assembly chart part list for AM'" />
                        <span>Referent Assembly chart part list for AM</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Head unit: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUEHUNIT === 'Head no.1'" />
                        <span>Head no.1</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUEHUNIT === 'Head no.2'" />
                        <span>Head no.2</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUEHUNIT === 'Head no.3'" />
                        <span>Head no.3</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Backup pin standard no.: </strong>


                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUESTDOK === 'OK'" />
                        <span>Confirm OK</span>
                    </div>
                    <span>{{ dataItem?.TEC_CPHREC_GLUESTDOK === null ? dataItem?.TEC_CPHREC_GLUESTDNOT : ''
                        }}</span>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>6) Glue (M/C #2): </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_GLUESND === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUESND === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Program name: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUESNDPROG === 'Referent Assembly chart part list for AM'" />
                        <span>Referent Assembly chart part list for AM</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Glue Number: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUESNDNUM === 'Referent Assembly chart part list for AM'" />
                        <span>Referent Assembly chart part list for AM</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Head unit: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUESNDHUNIT === 'Head no.1'" />
                        <span>Head no.1</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUESNDHUNIT === 'Head no.2'" />
                        <span>Head no.2</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUESNDHUNIT === 'Head no.3'" />
                        <span>Head no.3</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Backup pin standard no.: </strong>


                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_GLUESNDOK === 'OK'" />
                        <span>Confirm OK</span>
                    </div>
                    <span>{{ dataItem?.TEC_CPHREC_GLUESNDOK === null ? dataItem?.TEC_CPHREC_GLUESNDNOT : ''
                        }}</span>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>7) Mounter (M/C #1): </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_MNTF === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTF === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Program name: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFPROG === 'Referent Assembly chart part list for AM'" />
                        <span>Referent Assembly chart part list for AM</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Nozzle Setting: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFNOZ === 'Automatic'" />
                        <span>Automatic</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFNNOZ === 'Manual'" />
                        <span>Manual</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Support PCB: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFSUPT === 'Pin'" />
                        <span>Pin</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFSUPT === 'Magnet'" />
                        <span>Magnet</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFSUPT === 'Sponge'" />
                        <span>Sponge</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>8) Mounter (M/C #2): </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_MNTSN === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTSN === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Program name: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTSNPROG === 'Referent Assembly chart part list for AM'" />
                        <span>Referent Assembly chart part list for AM</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Nozzle Setting: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTSNNOZ === 'Automatic'" />
                        <span>Automatic</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTSNNOZ === 'Manual'" />
                        <span>Manual</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Support PCB: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTSNSUPT === 'Pin'" />
                        <span>Pin</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTSNSUPT === 'Magnet'" />
                        <span>Magnet</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTSNSUPT === 'Sponge'" />
                        <span>Sponge</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>9) Mounter (M/C #3): </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_MNTTR === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTTR === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Program name: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTTRPROG === 'Referent Assembly chart part list for AM'" />
                        <span>Referent Assembly chart part list for AM</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Nozzle Setting: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTTRNOZ === 'Automatic'" />
                        <span>Automatic</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTTRNOZ === 'Manual'" />
                        <span>Manual</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Support PCB: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTTRSUPT === 'Pin'" />
                        <span>Pin</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTTRSUPT === 'Magnet'" />
                        <span>Magnet</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTTRSUPT === 'Sponge'" />
                        <span>Sponge</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>10) Mounter (M/C #4): </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_MNTFO === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFO === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Program name: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFOPROG === 'Referent Assembly chart part list for AM'" />
                        <span>Referent Assembly chart part list for AM</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Nozzle Setting: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFONOZ === 'Automatic'" />
                        <span>Automatic</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFONOZ === 'Manual'" />
                        <span>Manual</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Support PCB: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFOSUPT === 'Pin'" />
                        <span>Pin</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFOSUPT === 'Magnet'" />
                        <span>Magnet</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTFOSUPT === 'Sponge'" />
                        <span>Sponge</span>
                    </div>
                </div>
            </div>




        </div>
        <div class="pa-3 border border-black w-[800px] bg-white mt-8 space-y-2">
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>11) Mounter Inspector: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_MNTINSP === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTINSP === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Program name: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_MNTINSPPROG === 'Referent Assembly chart part list for AM'" />
                        <span>Referent Assembly chart part list for AM</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>12) Reflow: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_REFLOW === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_REFLOW === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Program name: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_REFLPROG === 'Referent Assembly chart part list for AM'" />
                        <span>Referent Assembly chart part list for AM</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Oxygen: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_REFLOXYGEN === 'Use'" />
                        <span>Use</span>
                        <span>{{ dataItem?.TEC_CPHREC_REFLOXYGEN === 'Use' ? dataItem?.TEC_CPHREC_REFLOO : '' }}</span>
                        <input type="checkbox" class="w-4 h-4 mt-3 ms-3"
                            :checked="dataItem?.TEC_CPHREC_REFLOXYGEN === 'Not Use'" />
                        <span>Not Use</span>

                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> PCB Supporter: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_REFLPCBSUPT === 'Use'" />
                        <span>Use</span>

                        <input type="checkbox" class="w-4 h-4 mt-3 ms-3"
                            :checked="dataItem?.TEC_CPHREC_REFLPCBSUPT === 'Not Use'" />
                        <span>Not Use</span>

                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">

                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Temperature profile: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_REFLTEMP === 'Pass'" />
                        <span>Use</span>

                        <input type="checkbox" class="w-4 h-4 mt-3 ms-3"
                            :checked="dataItem?.TEC_CPHREC_REFLTEMP === 'No pass'" />
                        <span>Not Use</span>

                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>13) PCB Cooling: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_PCBCOOL === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_PCBCOOL === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>


            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>14) Auto Optic Inspection: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_AUTO === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_AUTO === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Program name: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_AUTOPROG === 'Referent Assembly chart part list for AM'" />
                        <span>Referent Assembly chart part list for AM</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>15) NG Stocker: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_NGSTCK === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_NGSTCK === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Pitch setting: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_NGSTCKPITCH === '10 mm.'" />
                        <span>10 mm.</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_NGSTCKPITCH === '20 mm.'" />
                        <span>20 mm.</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_NGSTCKPITCH === '30 mm.'" />
                        <span>30 mm.</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>16) Traceability Input: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3" :checked="dataItem?.TEC_CPHREC_TRACE === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_TRACE === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>


            </div>
            <div class="grid grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong>17) Unloader Input: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_UNLOADER === 'Use'" />
                        <span>Use</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_UNLOADER === 'Not Use'" />
                        <span>Not Use</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <strong> Pitch setting: </strong>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_UNLOADERPITCH === '10 mm.'" />
                        <span>10 mm.</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_UNLOADERPITCH === '20 mm.'" />
                        <span>20 mm.</span>
                        <input type="checkbox" class="w-4 h-4 mt-3"
                            :checked="dataItem?.TEC_CPHREC_UNLOADERPITCH === '30 mm.'" />
                        <span>30 mm.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { ref, watch, nextTick, defineProps } from 'vue'

import dayjs from 'dayjs'

const props = defineProps<{
    dataItem: any
}>()

const pdfTemplate = ref<HTMLElement | null>(null)

const dateFormat = (date: string) => dayjs(date).format('DD/MM/YYYY')

// Watch เมื่อ props.dataItem เปลี่ยน -> สร้าง PDF ทันที
watch(
    () => props.dataItem,
    async (newVal) => {
        if (!newVal) return
        await nextTick()
        generatePdf()
    },
    { immediate: true }
)

const generatePdf = async () => {
    if (!pdfTemplate.value) return

    const el = pdfTemplate.value
    el.style.display = 'block'
    el.style.position = 'absolute'
    el.style.left = '-9999px'
    el.style.top = '0'
    el.style.opacity = '1'
    el.style.fontSize = '12px'
    document.body.appendChild(el)

    await nextTick()


    const html2canvas = (await import('html2canvas')).default
    const { jsPDF } = await import('jspdf')

    const rect = el.getBoundingClientRect()
    if (rect.width === 0 || rect.height === 0) {
        console.error('Invalid element size for PDF')
        return
    }

    const canvas = await html2canvas(el, { scale: 2, useCORS: true })
    if (!canvas.width || !canvas.height) {
        console.error('Invalid canvas size')
        return
    }

    const imgData = canvas.toDataURL('image/jpeg', 1.0)
    const pdf = new jsPDF('p', 'mm', 'a4')
    const pdfWidth = pdf.internal.pageSize.getWidth()
    const pdfHeight = pdf.internal.pageSize.getHeight()

    const imgWidth = pdfWidth
    const imgHeight = (canvas.height * pdfWidth) / canvas.width

    let heightLeft = imgHeight
    let position = 0

    // เพิ่มภาพหน้าแรก
    pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight)
    heightLeft -= pdfHeight

    // ถ้ามีส่วนที่เกิน -> เพิ่มหน้าใหม่เรื่อย ๆ
    while (heightLeft > 0) {
        position = heightLeft - imgHeight
        pdf.addPage()
        pdf.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight)
        heightLeft -= pdfHeight
    }

    // เปิด PDF ในแท็บใหม่
    window.open(pdf.output('bloburl'), '_blank')

    el.style.display = 'none'
}
</script>
