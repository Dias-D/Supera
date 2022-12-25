<template>
  <maintenance-header />
  <maintenance />
</template>

<script>
import MaintenanceHeader from "./MaintenanceHeader.vue";
import Maintenance from "./Maintenance.vue";

export default {
  components: { Maintenance, MaintenanceHeader },
};
</script>

<style></style>
