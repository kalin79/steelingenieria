<template>
    <section class="bannerSeccion">
        <img src="/images/logoMaster.webp" />
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
    padding: 3rem 1.5rem;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 0.5rem;
    @media screen and (min-width: 992px) {
        flex-direction: row;
        adding: 3rem 0rem;
    }
    img {
        width: 194px;
        height: 42px;
    }
    h3 {
        font-family: $font-sans;
        font-weight: 400;
        color: white;
        font-size: 1.15rem;
        line-height: 1.5em;
        text-align: center;
        margin-top: 0.75rem;
        @media screen and (min-width: 992px) {
            text-align: left;
            font-size: 1.25rem;
            line-height: 1.5em;
            margin-top: 0rem;
        }
        br {
            display: none;
            @media screen and (min-width: 992px) {
                display: block;
            }
        }
    }
}
</style>
