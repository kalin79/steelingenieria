<template>
    <section class="bannerSeccion">
        <img src="/images/logotente.png" />
        <h3>
            STEEL Ingeniería, distribuidor autorizado en el Perú de
            <br />productos MasterMover.
        </h3>
    </section>
</template>
<script setup></script>
<style lang="scss" scoped>
.bannerSeccion {
    background: $color-primary-dark;
    padding: 3rem 0;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    img {
        width: 175px;
        height: 66px;
    }
    h3 {
        font-family: $font-sans;
        font-weight: 400;
        color: white;
        font-size: 1.25rem;
        line-height: 1.5em;
    }
}
</style>
