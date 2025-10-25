export default defineNuxtRouteMiddleware(async (to) => {
  // ถ้ามี param จาก URL
  if (to.query.empno) {
    await $fetch(
      "http://172.22.64.11/49_modelchange/49_mdlchn_api/session/user",
      {
        method: "GET",
        query: {
          username: to.query.username,
          empno: to.query.empno,
          department: to.query.department,
          USE_PERMISSION: to.query.USE_PERMISSION,
          sec: to.query.sec,
          MSECT_ID: to.query.MSECT_ID,
        },
        credentials: "include",
      }
    );

    // ล้าง query ออกจาก URL (เพื่อความปลอดภัย)
    return navigateTo("/", { replace: true });
  }
});
