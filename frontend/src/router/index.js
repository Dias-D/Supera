import { createRouter, createWebHistory } from "vue-router";

const Maintenances = () => import("../views/Maintenances/index.vue");
const Home = () => import("../views/Home/index.vue");

const router = createRouter({
  history: createWebHistory("/"),
  routes: [
    {
      path: "/",
      name: "Home",
      component: Home,
    },
    {
      path: "/Maintenances",
      name: "Maintenances",
      component: Maintenances,
      meta: {
        hasAuth: true,
      },
    },
    {
      path: "/:pathMatch(.*)*",
      redirect: { name: "Home" },
    },
  ],
});

export default router;
