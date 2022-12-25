<template>
  <custom-header @create-account="handleAccountCreate" @login="handleLogin" />
  <welcome />
  <div class="flex justify-center items-center h-1/6 py-10 bg-black">
    <p class="font-medium text-center text-white">Maintenance's Car 2022</p>
  </div>
</template>
<script>
import { onMounted } from "vue";
import { useRouter } from "vue-router";
import CustomHeader from "./CustomHeader.vue";
import Welcome from "./Welcome.vue";
import useModal from "../../hooks/useModal";

export default {
  components: { CustomHeader, Welcome },
  setup() {
    const router = useRouter();
    const modal = useModal();

    onMounted(() => {
      const token = window.localStorage.getItem("token");
      if (token) {
        router.push({ name: "Maintenances" });
      }
    });

    function handleLogin() {
      modal.open({ component: "ModalLogin" });
    }

    function handleAccountCreate() {
      modal.open({ component: "ModalCreateAccount" });
    }
    return {
      handleLogin,
      handleAccountCreate,
    };
  },
};
</script>
