<script setup lang="ts">
import Sidebar from "~/components/sidebar.vue";
import { ref, onMounted } from "vue";
import axios from "axios";

const { public: config } = useRuntimeConfig();
console.log(config.apiBase);

const user = ref<any>(null);
const username = ref<string>("");

/**
 *  TODO: เรียกข้อมูล session ผู้ใช้งาน
 */
const sessionUser = async () => {
    const res = await axios.get(`${config.apiBase}/session/user`, {
        withCredentials: true, // ต้องใส่ เพื่อส่ง laravel_session cookie
    });

    user.value = res.data;
    console.log("user session:", user.value);
    username.value = user.value?.username || "";
};

onMounted(() => {
    sessionUser();
});
</script>

<template>
    <v-app>
        <!-- App Bar -->
        <v-app-bar app color="blue" class="px-4 flex justify-between items-center">
            <!-- ซ้าย -->
            <div class="flex items-center gap-3">
                <v-img src="/blockchain.png" alt="Logo" width="32" height="32" contain></v-img>
                <span class="font-bold text-white text-xl tracking-wide">
                    Model Change Record System
                </span>
            </div>

            <!-- ขวา -->
            <div class="flex items-center gap-2 ml-auto">
                <v-icon icon="mdi-account-circle" size="26" color="white"></v-icon>
                <span class="text-white font-medium">
                    {{ username }}
                </span>
            </div>
        </v-app-bar>

        <!-- Sidebar + Main -->
        <Sidebar />

        <v-main class="p-4">
            <v-container>
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>
