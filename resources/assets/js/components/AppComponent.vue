<template>
    <div>
        <transition name="fade"
                mode="out-in">
      <router-view></router-view>
    </transition>
    </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>

<style lang="scss">
.notifications.vue-notifyjs {
  .notification-list-move {
    transition: transform 0.3s, opacity 0.4s;
  }
  .notification-list-item {
    display: inline-block;
    margin-right: 10px;
  }
  .notification-list-enter-active,
  .notification-list-leave-active {
    transition: opacity 0.4s;
  }
  .notification-list-enter,
  .notification-list-leave-to {
    opacity: 0;
  }
}
</style>
