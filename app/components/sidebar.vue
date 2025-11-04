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

<script setup lang="ts">
import { ref, watch, onMounted, computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";

const route = useRoute();
const router = useRouter();

const activemenu = ref(route.path);

watch(
    () => route.path,
    (newPath) => {
        activemenu.value = newPath;
    }
);

const toggleMenu = (menuPath: string) => {
    activemenu.value = menuPath;
};

// 🌟 เพิ่มคุณสมบัติ 'permission' เข้าไปในแต่ละเมนู
const menu = ref([
    {
        id: 1,
        icon: "mdi mdi-database-cog",
        to: "/appMaster",
        label: "สายอนุมัติ",
        permission: [2, 7, 8, 9],
    },
    {
        id: 2,
        icon: "mdi mdi-numeric-1-box",
        to: "/",
        label: "แบบฟอร์ม Operator",
        permission: [1, 3, 7],
    },
    {
        id: 3,
        icon: "mdi mdi-numeric-2-box",
        to: "/tech_record",
        label: "แบบฟอร์ม Technichian",
        permission: [2, 4, 7],
    },
    {
        id: 4,
        icon: "mdi mdi-file-document-check",
        to: "/dataApp",
        label: "อนุมัติ CP Process",
        permission: [7, 8, 9],
    },
    {
        id: 5,
        icon: "mdi mdi-file-document-check",
        to: "/dataRf",
        label: "อนุมัติ RF Process",
        permission: [7, 8, 9],
    },
    {
        id: 6,
        icon: "mdi mdi-chart-box",
        to: "/report",
        label: "Report CP Process",
        permission: [7, 8, 9],
    },
    {
        id: 7,
        icon: "mdi mdi-chart-box",
        to: "/report2",
        label: "Report RF Process",
        permission: [7, 8, 9],
    },
]);

const { public: config } = useRuntimeConfig();
const user = ref<any>(null);
const permission = ref<number>(0);

// ✅ เรียกข้อมูล session ผู้ใช้งาน
const sessionUser = async () => {
    try {
        const res = await axios.get(`${config.apiBase}/session/user`, {
            withCredentials: true,
        });

        user.value = res.data;
        permission.value = user.value?.permission || 0;

        console.log("👤 User session:", user.value);
        console.log("🔑 Permission:", permission.value);

        // ตรวจสอบสิทธิ์ในหน้าแรกเมื่อโหลดเสร็จ
        checkAccessToCurrentRoute();
    } catch (error) {
        console.error("❌ Error fetching user session:", error);
    }
};

// ✅ กรองเมนูตามสิทธิ์
const filteredMenu = computed(() => {
    return menu.value.filter((m) => {
        if (Array.isArray(m.permission)) {
            const hasAccess = m.permission.some((perm) => permission.value == perm);
            console.log(
                `📋 เมนู "${m.label}" | ผู้ใช้ = ${permission.value} | แสดงผล: ${hasAccess}`
            );
            return hasAccess;
        } else {
            return permission.value == m.permission;
        }
    });
});

// ✅ ตรวจสอบสิทธิ์ของหน้า route ปัจจุบัน
const checkAccessToCurrentRoute = () => {
    const currentPath = route.path;
    const menuItem = menu.value.find((m) => m.to === currentPath);

    // ถ้ามีเมนูนี้ แต่ผู้ใช้ไม่มีสิทธิ์ → redirect ไปหน้าแรกที่เข้าได้
    if (menuItem && Array.isArray(menuItem.permission)) {
        const hasAccess = menuItem.permission.some((perm) => permission.value == perm);
        if (!hasAccess) {
            console.warn(`🚫 ผู้ใช้ไม่มีสิทธิ์เข้าหน้า ${currentPath}`);
            // หาเมนูแรกที่มีสิทธิ์เข้าได้
            const firstAllowed = filteredMenu.value[0];
            if (firstAllowed) {
                router.push(firstAllowed.to);
            } else {
                router.push("/"); // ถ้าไม่มีสิทธิ์เลย ให้กลับหน้า default
            }
        }
    }
};

onMounted(() => {
    sessionUser();
});
</script>
