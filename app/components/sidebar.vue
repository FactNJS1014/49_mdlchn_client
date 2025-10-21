<template>
    <v-navigation-drawer app permanent color="blue-lighten-5">
        <v-list density="comfortable" nav>
            <v-list-item v-for="m in menu" :key="m.id" :to="m.to" router exact :active="activemenu === m.to"
                @click="toggleMenu(m.to)" :color="activemenu === m.to ? 'light-blue-darken-4' : undefined"
                variant="tonal">
                <template #prepend>
                    <v-icon :icon="m.icon"></v-icon>
                </template>
                <template #title>
                    <p class="font-semibold text-md">{{ m.label }}</p>
                </template>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>




</template>

<script setup>
import { ref, watch } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const activemenu = ref(route.path);

watch(
    () => route.path,
    (newPath) => {
        activemenu.value = newPath;
    }
);

const toggleMenu = (menuPath) => {
    w
    activemenu.value = menuPath;
};

const menu = ref([
    { id: 1, icon: "mdi mdi-numeric-1-box", to: "/", label: "แบบฟอร์ม Operator" },
    { id: 2, icon: "mdi mdi-numeric-2-box", to: "/tech_record", label: "แบบฟอร์ม Technichian" },
    { id: 3, icon: "mdi mdi-file-document-check", to: "/dataApp", label: "เอกสารอนุมัติ CP Process" },
    { id: 4, icon: "mdi mdi-file-document-check", to: "/dataRf", label: "เอกสารอนุมัติ RF Process" },
    { id: 5, icon: "mdi mdi-database-cog", to: "/appMaster", label: "สายอนุมัติ" },
]);
</script>
