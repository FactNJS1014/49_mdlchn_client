<script setup>
import Sidebar from "~/components/sidebar.vue";
</script>

<template>
    <v-app>
        <!-- App Bar -->
        <v-app-bar app color="blue" class="px-4">
            <!-- ใช้ flex row, align center -->
            <div class="flex items-center gap-3">
                <!-- รูปโลโก้ -->
                <v-img src="/blockchain.png" alt="Logo" width="30" height="30" contain></v-img>

                <!-- ข้อความ -->
                <span class="font-bold text-white text-lg">Model Change Record System</span>
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
