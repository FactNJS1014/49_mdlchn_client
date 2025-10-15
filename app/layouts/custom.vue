<script setup>
import Sidebar from "~/components/sidebar.vue";
</script>

<template>
    <v-app>
        <!-- App Bar -->
        <v-app-bar app color="blue">
            <v-app-bar-title style="font-weight: bold">
                <v-img src="/blockchain.png" alt="Logo" width="25" height="25" />
                <h1>Model Change</h1>
            </v-app-bar-title>
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
