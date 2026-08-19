<template>
    <section class="descripcionServicioSection">
        <!-- Imagen de contenido: va como <img>, no como background, para que
             el preload scanner la descubra y podamos darle alt y prioridad. -->
        <div class="bg">
            <img
                :src="`/images/${dataDescripcion.imagen}`"
                :alt="dataDescripcion.imagenAlt || ''"
                :loading="prioridad ? 'eager' : 'lazy'"
                :fetchpriority="prioridad ? 'high' : 'auto'"
                decoding="async"
            />
        </div>

        <div class="container">
            <div class="layoutContainer">
                <div class="contenido">
                    <div class="etiquetaContainer">
                        <span>{{ dataDescripcion.etiqueta }}</span>
                    </div>
                    <h2 v-html="dataDescripcion.title"></h2>
                    <div
                        class="descripcionContent"
                        v-html="dataDescripcion.descripcion"
                    ></div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
defineProps({
    dataDescripcion: {
        type: Object,
        required: true,
    },
    prioridad: {
        type: Boolean,
        default: false,
    },
});
</script>

<style lang="scss" scoped>
.descripcionServicioSection {
    background-image: url("/images/f2.webp");
    background-position: top right;
    background-size: contain;
    background-repeat: repeat;
    position: relative;

    .bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;

        img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        // Capa de contraste para que el texto siga siendo legible cuando la
        // imagen ocupa todo el ancho en pantallas chicas.
        &::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.85);
        }

        @media screen and (min-width: 992px) {
            width: 45%;

            &::after {
                display: none;
            }
        }
    }

    .container {
        position: relative;
        z-index: 2;

        .layoutContainer {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: 1rem;
            padding: 3rem 0;

            @media screen and (min-width: 992px) {
                padding: 5rem 0;
            }

            .contenido {
                grid-column: 1 / -1;

                @media screen and (min-width: 992px) {
                    grid-column: 7 / -1;
                }

                h2 {
                    font-size: 1.5rem;
                    line-height: 1.25em;
                    color: $color-text-light;
                    font-family: $font-sans;
                    font-weight: 400;
                    margin: 1rem 0 0.5rem;

                    @media screen and (min-width: 992px) {
                        font-size: 1.65rem;
                        line-height: 1.5em;
                    }

                    @media screen and (min-width: 1200px) {
                        font-size: 1.875rem;
                        line-height: 1.25em;
                    }
                }

                .descripcionContent {
                    font-size: 1rem;
                    line-height: 1.5em;
                    color: $color-text-light;
                    font-family: $font-sans;
                    font-weight: 400;
                    margin: 1rem 0 0.5rem;

                    @media screen and (min-width: 1200px) {
                        font-size: 1.125rem;
                        line-height: 1.4em;
                    }
                }

                .etiquetaContainer {
                    border: 1px solid $color-primary-light;
                    border-radius: 30px;
                    min-width: 216px;
                    padding: 0 1rem;
                    height: 34px;
                    display: inline-block;
                    text-align: center;

                    span {
                        font-size: 0.9rem;
                        line-height: 2.35em;
                        color: $color-primary-light;
                        font-family: $font-red;
                        font-weight: 600;

                        @media screen and (min-width: 1200px) {
                            font-size: 1rem;
                            line-height: 2em;
                        }
                    }
                }
            }
        }
    }
}
</style>
