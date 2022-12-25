<template>
  <teleport to="body">
    <div
      v-if="state.isActive"
      @click="handleModalToogle({ status: false })"
      class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50"
    >
      <div class="fixed mx-10" :class="state.width" @click.stop>
        <div
          class="flex flex-col overflow-hidden bg-white rounded-lg animate__animated animate__fadeInDown animate__faster"
        >
          <div class="flex flex-col px-12 py-10 bg-white">
            <component :is="state.component" />
          </div>
        </div>
      </div>
    </div>
  </teleport>
</template>

<script>
import {
  defineAsyncComponent,
  onBeforeUnmount,
  onMounted,
  reactive,
} from "vue";
import useModal from "../../hooks/useModal";

const ModalLogin = defineAsyncComponent(() =>
  import("../ModalLogin/index.vue")
);
const ModalCreateAccount = defineAsyncComponent(() =>
  import("../ModalCreateAccount/index.vue")
);
const DEFAULT_WIDTH = "w-3/4 lg:w-1/3";

export default {
  components: {
    ModalLogin,
    ModalCreateAccount,
  },
  setup() {
    const state = reactive({
      isActive: false,
      component: {},
      props: {},
      width: DEFAULT_WIDTH,
    });
    const modal = useModal();

    onMounted(() => {
      modal.listen(handleModalToogle);
    });

    onBeforeUnmount(() => {
      modal.off(handleModalToogle);
    });

    function handleModalToogle(payload) {
      if (payload.status) {
        state.component = payload.component;
        state.props = payload.props;
        state.width = payload.width ?? DEFAULT_WIDTH;
      }

      if (!payload.status) {
        state.component = {};
        state.props = {};
        state.width = DEFAULT_WIDTH;
      }

      state.isActive = payload.status;
    }

    return { state, handleModalToogle };
  },
};
</script>
