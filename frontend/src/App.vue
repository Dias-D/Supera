<template>
  <modal-factory />
  <router-view />
</template>

<script>
import { watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import services from "./services";
import ModalFactory from "./components/ModalFactory/index.vue";
import { setCurrentuser } from "./store/user";

export default {
  components: { ModalFactory },
  setup() {
    const router = useRouter();
    const route = useRoute();

    watch(
      () => route.path,
      async () => {
        if (route.meta.hasAuth) {
          const token = window.localStorage.getItem("token");

          if (!token) {
            router.push({ name: "Home" });
            return;
          }

          const { data } = await services.users.getMe();
          setCurrentuser(data);
          console.log("data", data);
        }
      }
    );
  },
};
</script>
