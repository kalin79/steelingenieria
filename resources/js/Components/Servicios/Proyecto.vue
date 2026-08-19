<template>
    <div class="proyectyosServiciosSection">
        <div class="container">
            <div class="headerContainer">
                <div>
                    <h2 v-html="dataProyecto.title"></h2>
                </div>
            </div>
            <div class="bodyContainer">
                <div class="carruselProyectos">
                    <Splide
                        ref="carruselRef"
                        :options="options"
                        @splide:mounted="onMounted"
                    >
                        <SplideSlide
                            v-for="(proyecto, index) in dataProyecto.items"
                            :key="index"
                            class="carrusel__slide"
                        >
                            <Link :href="proyecto.link" class="cardBox">
                                <div class="cardHeader">
                                    <img :src="proyecto.imagen" />
                                </div>
                                <div class="cardBody">
                                    <h2 v-html="proyecto.title"></h2>
                                </div>
                            </Link>
                        </SplideSlide>
                    </Splide>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { Splide, SplideSlide, SplideTrack } from "@splidejs/vue-splide";
import "@splidejs/vue-splide/css";
defineProps({
    dataProyecto: {
        type: Object,
        required: true,
    },
});
const carruselRef = ref(null);

// Opciones de Splide (fácil de entender)
const options = {
    type: "slide", // <- antes "fade". Con perPage > 1 usa "loop" o "slide"
    perPage: 3,
    perMove: 1,
    gap: "1.75rem", // <- antes 0
    autoplay: true,
    interval: 5000,
    pauseOnHover: true,
    pauseOnFocus: true,
    arrows: false,
    pagination: true,
    speed: 600,
    breakpoints: {
        1200: { perPage: 3, gap: "1.25rem" },
        992: { perPage: 2, gap: "1.25rem" },
        640: { perPage: 1, gap: "1rem" },
    },
};
const onMounted = () => {
    document.fonts?.ready.then(() => carruselRef.value?.splide.refresh());
};
</script>
<style lang="scss">
.proyectyosServiciosSection {
    .bodyContainer {
        margin-top: 2rem;
        .carruselProyectos {
            width: 100%;
            min-width: 0;
            .cardBox {
                flex: 1;
                // border: 1px solid blue;
                background: rgba(#253773, 1);
                border-radius: 30px;
                padding: 0 0 0rem 0;
                overflow: hidden;
                position: relative;
                &:before {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    background: rgba(#000, 0.35);
                    width: 100%;
                    height: 100%;
                }

                .cardBody {
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    padding: 1rem 2rem;
                    z-index: 2;
                    h2 {
                        font-size: 1rem;
                        line-height: 1.35em;
                        color: white;
                        font-family: $font-sans;
                        font-weight: 400;
                        @media screen and (min-width: 992px) {
                            font-size: 1.1rem;
                            line-height: 1.24em;
                        }
                        @media screen and (min-width: 1200px) {
                            font-size: 1.125rem;
                            line-height: 1.25em;
                        }
                    }
                }
                .cardHeader {
                    display: flex;
                    justify-content: flex-start;
                    align-items: center;
                    gap: 1rem;
                    padding: 0;

                    img {
                        object-fit: cover;
                        width: 100%;
                        height: 100%;
                    }
                }
                &:hover {
                    .blurBox {
                        opacity: 1;
                    }
                    .lightBox {
                        transform: translateY(0);

                        .titularBox p {
                            opacity: 1;
                            transform: translateY(0);
                        }

                        .botonBox {
                            opacity: 1;
                            transform: translateX(0);
                        }
                    }
                }
            }
            .splide__track {
                height: auto;
            } // <- quita el height: 100%
            .splide__list {
                align-items: stretch;
            }
            .splide__slide {
                height: auto;
                display: flex;
            }
            .splide__slide > * {
                width: 100%;
            }
        }
    }
}
</style>

<style lang="scss" scoped>
.proyectyosServiciosSection {
    background: white;
    padding: 0rem 0 8rem;
    overflow: hidden;
    .headerContainer {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1rem;
        > div {
            &:nth-of-type(1) {
                grid-column: 1 / -1;
            }
        }
        h2 {
            font-size: 1.5rem;
            line-height: 1.25em;
            color: $color-text-light;
            font-family: $font-archia;
            font-weight: 500;
            margin: 1rem 0 0.5rem;

            @media screen and (min-width: 992px) {
                font-size: 1.65rem;
                line-height: 1.25em;
            }

            @media screen and (min-width: 1200px) {
                font-size: 1.875rem;
                line-height: 1.25em;
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
</style>
