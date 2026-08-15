<template>
    <section class="sectionServicios">
        <div class="bgServicio"></div>
        <div class="container">
            <div class="layoutContainer">
                <div>
                    <div class="etiquetaContainer">
                        <span>Servicios</span>
                    </div>
                    <div class="titularContainer">
                        <h2>
                            Soluciones <br />
                            de Ingenier&iacute;a
                        </h2>
                    </div>
                </div>
                <div>
                    <div class="cardsContainer">
                        <Splide
                            ref="carruselRef"
                            :options="options"
                            @splide:mounted="onMounted"
                        >
                            <SplideSlide
                                v-for="(servicio, index) in servicios"
                                :key="index"
                                class="carrusel__slide"
                            >
                                <div class="cardBox">
                                    <div class="cardHeader">
                                        <img :src="servicio.image" />
                                    </div>
                                    <div class="cardBody">
                                        <h3 v-html="servicio.title"></h3>
                                        <p v-html="servicio.description"></p>
                                    </div>
                                </div>
                            </SplideSlide>
                        </Splide>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { Splide, SplideSlide, SplideTrack } from "@splidejs/vue-splide";
import "@splidejs/vue-splide/css";
const carruselRef = ref(null);
const servicios = [
    {
        id: 1,
        title: "Fabricaciones",
        description: `Fabricación de piezas y estructuras metálicas con precisión, calidad y control en cada etapa del proceso.`,
        image: "/images/ss1.webp",
        link: `#`,
    },
    {
        id: 2,
        title: "Montaje y mantenimiento <br />metálico",
        description: `Montaje especializado de equipos, estructuras y sistemas bajo estándares industriales.`,
        image: "/images/ss2.webp",
        link: `#`,
    },
    {
        id: 3,
        title: "Ingeniería y diseño",
        description: `Diseñamos soluciones industriales eficientes mediante ingeniería especializada y desarrollo técnico.`,
        image: "/images/ss3.webp",
        link: `#`,
    },
];
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
.cardsContainer {
    width: 100%;
    min-width: 0;
    position: relative;
    @media screen and (min-width: 992px) {
        bottom: -8.5rem;
    }
    .cardBox {
        flex: 1;
        // border: 1px solid blue;
        background: rgba(#2d438e, 1);
        border-radius: 30px;
        padding: 0 0 3rem 0;
        overflow: hidden;
        .cardBody {
            padding: 1rem 2rem;
            h3 {
                font-size: 1rem;
                line-height: 1.35em;
                color: $color-primary-light;
                font-family: $font-sans;
                font-weight: 500;
                margin-bottom: 0.65rem;
                @media screen and (min-width: 992px) {
                    font-size: 1rem;
                    line-height: 1.35em;
                }
                @media screen and (min-width: 1200px) {
                    font-size: 1.25rem;
                    line-height: 1.25em;
                }
            }
            p {
                font-size: 1rem;
                line-height: 1.5em;
                color: white;
                font-family: $font-sans;
                font-weight: 400;
                @media screen and (min-width: 992px) {
                    font-size: 0.9rem;
                    line-height: 1.4em;
                }
                @media screen and (min-width: 1200px) {
                    font-size: 1rem;
                    line-height: 1.5em;
                }
            }
        }
        .cardHeader {
            height: 280px;
            img {
                object-fit: contain;
                width: auto;
                height: auto;
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
</style>
<style lang="scss" scoped>
.sectionServicios {
    position: relative;
    z-index: 10;
    background: $color-text-light;
    .container {
        position: relative;
        z-index: 3;
    }
    .bgServicio {
        background-image: url("/images/fondoservicio.webp");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 580px;
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
    }

    .layoutContainer {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1rem;
        padding: 5rem 0 3rem;

        > div {
            &:nth-of-type(2) {
                grid-column: 1 / -1;
                padding-top: 1.5rem;
                @media screen and (min-width: 992px) {
                    grid-column: 4 / -1;
                    padding-top: 1.5rem;
                }
            }
            &:nth-of-type(1) {
                grid-column: 1 / -1;
                @media screen and (min-width: 992px) {
                    grid-column: 1 / span 3;
                }
                .etiquetaContainer {
                    border: 1px solid white;
                    border-radius: 30px;
                    min-width: 171px;
                    height: 34px;
                    display: inline-block;
                    text-align: center;
                    span {
                        font-size: 0.9rem;
                        line-height: 2.35em;
                        color: white;
                        font-family: $font-red;
                        font-weight: 600;
                        @media screen and (min-width: 992px) {
                            font-size: 0.9rem;
                            line-height: 2.35em;
                        }
                        @media screen and (min-width: 1200px) {
                            font-size: 1rem;
                            line-height: 2em;
                        }
                    }
                }

                .titularContainer {
                    margin: 1.5rem 0;
                    h2 {
                        line-height: 1.15em;
                        font-size: 2rem;
                        color: #fff;
                        font-family: $font-archia;
                        font-weight: 500;

                        @media screen and (min-width: 992px) {
                            line-height: 1.15em;
                            font-size: 2.325rem;
                        }
                        @media screen and (min-width: 1200px) {
                            line-height: 1em;
                            font-size: 2.625rem;
                            letter-spacing: -0.03em;
                        }
                        @media screen and (min-width: 1400px) {
                            letter-spacing: 0;
                        }
                    }
                }
            }
        }
    }
}
</style>
