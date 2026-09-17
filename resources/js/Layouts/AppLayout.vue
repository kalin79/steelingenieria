<template>
    <SeoHead />

    <div class="app-wrapper">
        <Header />

        <main role="main">
            <slot />
        </main>

        <Footer />
    </div>
</template>

<script setup>
import SeoHead from "@/Components/SeoHead.vue";
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
</script>

<style lang="scss" scoped>
// NO necesitas importar variables - están disponibles globalmente
// porque importas resources/sass/app.scss en resources/js/app.js

.app-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background: $color-bg;
}

.app-content {
    flex: 1;
    padding: $spacing-xl $spacing-md;
    max-width: $max-width-container;
    width: 100%;
    margin: 0 auto;

    // Responsive
    @include respond-to("md") {
        padding: $spacing-lg $spacing-sm;
    }
}
</style>
