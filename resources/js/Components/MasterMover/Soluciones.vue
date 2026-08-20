<template>
    <div class="solucionesSection">
        <div class="container">
            <div class="headerContainer">
                <div class="layoutContainer">
                    <div>
                        <h2>
                            Soluciones de remolque <br />
                            para cada desafío <br />
                            industrial
                        </h2>
                    </div>
                    <div>
                        <p>
                            Descubre una nueva forma de transportar cargas
                            pesadas mediante <br />remolcadores eléctricos de
                            última generación. Equipos confiables, eficientes y
                            <br />
                            diseñados para responder a las exigencias de la
                            industria moderna.
                        </p>
                    </div>
                </div>
            </div>
            <div class="bodyContainer">
                <div class="layoutContainer">
                    <div class="carruselSoluciones">
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
                                <Link :href="servicio.link" class="cardBox">
                                    <div class="cardHeader">
                                        <img :src="servicio.icono" />
                                        <h3>{{ servicio.kilos }}</h3>
                                    </div>
                                    <div class="cardBody">
                                        <img :src="servicio.image" />
                                    </div>
                                    <div class="cardFooter">
                                        <div class="titularBox">
                                            <h3 v-html="servicio.subtitle"></h3>
                                            <h2 v-html="servicio.title"></h2>
                                        </div>
                                        <div class="masBox">
                                            <img src="/images/mas.svg" />
                                        </div>
                                    </div>
                                    <div class="blurBox"></div>
                                    <div class="lightBox">
                                        <div class="titularBox">
                                            <h3 v-html="servicio.subtitle"></h3>
                                            <h2 v-html="servicio.title"></h2>
                                            <p
                                                v-html="servicio.description"
                                            ></p>
                                        </div>
                                        <div class="botonBox">
                                            <span>{{
                                                servicio.botonTexto
                                            }}</span>
                                        </div>
                                    </div>
                                </Link>
                            </SplideSlide>
                        </Splide>
                    </div>
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
const carruselRef = ref(null);
const servicios = [
    {
        id: 1,
        subtitle: "SERIE",
        title: "SmartMover",
        kilos: `hasta 2,000 kg.`,
        description: `Mueva fácilmente carros con ruedas de hasta 2,000 kg con la gama de arrastradores SmartMover.`,
        icono: "/images/kg.svg",
        image: "/images/s11.webp",
        botonTexto: `VER EQUIPOS SMARTMOVER`,
        link: `/soluciones/master-mover/smartmover`,
    },
    {
        id: 2,
        subtitle: "SERIE",
        title: "MasterTow",
        kilos: `hasta 20,000 kg.`,
        description: `La gama MasterTow de potentes y fáciles de usar arrastradores eléctricos es ideal para cargas y carros de hasta 20.000 kg.`,
        icono: "/images/kg.svg",
        image: "/images/s12.webp",
        botonTexto: `VER EQUIPOS SMARTMOVER`,
        link: `/soluciones/master-mover/mastertow`,
    },
    {
        id: 3,
        subtitle: "SERIE",
        title: "MasterTug",
        kilos: `hasta 20,000 kg.`,
        description: `La gama MasterTug ofrece una maniobrabilidad inigualable a la hora de mover cargas pesadas con ruedas de hasta 20.000 kg.`,
        icono: "/images/kg.svg",
        image: "/images/s13.webp",
        botonTexto: `VER EQUIPOS SMARTMOVER`,
        link: `/soluciones/master-mover/mastertug`,
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
.carruselSoluciones {
    width: 100%;
    min-width: 0;
    margin-top: 2rem;
    @media screen and (min-width: 992px) {
        margin-top: 5rem;
    }
    .cardBox {
        flex: 1;
        // border: 1px solid blue;
        background: rgba(#253773, 1);
        border-radius: 30px;
        padding: 0 0 3rem 0;
        overflow: hidden;
        position: relative;
        .blurBox {
            position: absolute;
            top: 20%;
            left: 0;
            width: 100%;
            height: 100%;
            // background: rgba(255, 255, 255, 0.25); // semi-transparente
            -webkit-backdrop-filter: blur(12px); // para Safari
            backdrop-filter: blur(12px); // desenfoca lo de detrás
            z-index: 9;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
        }
        .lightBox {
            position: absolute;
            bottom: 0;
            transform: translateY(100%);
            transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
            left: 0;
            z-index: 10;
            padding: 0.5rem 2rem 3rem;
            .botonBox {
                width: 200px;
                height: 50px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border-radius: 30px;
                background: $color-secondary;
                margin-top: 2rem;
                opacity: 0;
                transform: translateX(-40px); // entra de izquierda a derecha
                transition:
                    opacity 0.4s ease 0.55s,
                    transform 0.4s ease 0.55s;
                @media screen and (min-width: 992px) {
                    width: 250px;
                    height: 50px;
                }
                @media screen and (min-width: 1200px) {
                    width: 264px;
                    height: 60px;
                }
                span {
                    font-family: $font-red;
                    font-weight: bold;
                    font-size: 0.7rem;
                    line-height: 1.5em;
                    color: $color-text2;
                    @media screen and (min-width: 992px) {
                        font-size: 0.85rem;
                        line-height: 1.5em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 0.875rem;
                        line-height: 1.5em;
                    }
                }
            }
            .titularBox {
                h3,
                h2 {
                    opacity: 1; // se ven juntos desde el principio
                    transform: translateY(0);
                }
                p {
                    opacity: 0;
                    transform: translateY(15px);
                    transition:
                        opacity 0.35s ease 0.35s,
                        // aparece después de que sube
                        transform 0.35s ease 0.35s;
                }
                p {
                    font-size: 1.125rem;
                    line-height: 1.15em;
                    color: white;
                    font-family: $font-sans;
                    font-weight: 400;
                    @media screen and (min-width: 992px) {
                        font-size: 1.125rem;
                        line-height: 1.5em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1.125rem;
                        line-height: 1.5em;
                    }
                }
                h3 {
                    font-size: 1rem;
                    line-height: 1.5em;
                    color: $color-secondary;
                    font-family: $font-sans;
                    font-weight: 500;
                    letter-spacing: 0.05em;
                    @media screen and (min-width: 992px) {
                        font-size: 1.1rem;
                        line-height: 1.4em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1.125rem;
                        line-height: 1.5em;
                    }
                }
                h2 {
                    font-size: 1.25rem;
                    line-height: 1.15em;
                    color: white;
                    font-family: $font-sans;
                    font-weight: 400;
                    @media screen and (min-width: 992px) {
                        font-size: 1.475rem;
                        line-height: 1.35em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1.875rem;
                        line-height: 1.25em;
                    }
                }
            }
        }
        .cardFooter {
            padding: 0.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            .titularBox {
                h3 {
                    font-size: 1rem;
                    line-height: 1.5em;
                    color: $color-secondary;
                    font-family: $font-sans;
                    font-weight: 500;
                    letter-spacing: 0.05em;
                    @media screen and (min-width: 992px) {
                        font-size: 1.1rem;
                        line-height: 1.4em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1.125rem;
                        line-height: 1.5em;
                    }
                }
                h2 {
                    font-size: 1.25rem;
                    line-height: 1.15em;
                    color: white;
                    font-family: $font-sans;
                    font-weight: 400;
                    @media screen and (min-width: 992px) {
                        font-size: 1.475rem;
                        line-height: 1.35em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1.875rem;
                        line-height: 1.25em;
                    }
                }
            }
        }
        .cardBody {
            padding: 1rem 2rem;
            max-height: 280px;
            display: flex;
            justify-content: center;
            img {
                width: 100%;
                height: auto;
                object-fit: contain;
            }
        }
        .cardHeader {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem 2rem;
            h3 {
                font-size: 1rem;
                line-height: 1.5em;
                color: white;
                font-family: $font-sans;
                font-weight: 400;
                @media screen and (min-width: 992px) {
                    font-size: 1.1rem;
                    line-height: 1.4em;
                }
                @media screen and (min-width: 1200px) {
                    font-size: 1.125rem;
                    line-height: 1.5em;
                }
            }
            img {
                object-fit: contain;
                width: auto;
                height: auto;
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
</style>
<style lang="scss" scoped>
.solucionesSection {
    padding: 3rem 0;
    background: white;
    @media screen and (min-width: 992px) {
        padding: 5rem 0;
    }
    .headerContainer {
        .layoutContainer {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1rem;
            > div {
                &:nth-of-type(1) {
                    grid-column: 1 / -1;
                    @media screen and (min-width: 992px) {
                        grid-column: 1 / span 6;
                    }
                    h2 {
                        font-size: 2rem;
                        line-height: 1em;
                        color: #000;
                        font-family: $font-archia;
                        font-weight: 500;
                        margin: 1rem 0 0.5rem;
                        @media screen and (min-width: 992px) {
                            font-size: 2.125rem;
                            line-height: 1em;
                        }
                        @media screen and (min-width: 1200px) {
                            font-size: 2.625rem;
                            line-height: 1em;
                        }
                        br {
                            display: none;
                            @media screen and (min-width: 992px) {
                                display: block;
                            }
                        }
                    }
                }
                &:nth-of-type(2) {
                    grid-column: 1 / -1;
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-end;
                    @media screen and (min-width: 992px) {
                        grid-column: 7 / -1;
                    }
                    p {
                        font-size: 1rem;
                        line-height: 1.5em;
                        color: #000;
                        font-family: $font-sans;
                        font-weight: 400;
                        margin: 0rem 0 0.5rem;
                        @media screen and (min-width: 992px) {
                            font-size: 1rem;
                            line-height: 1.5em;
                            margin: 1rem 0 0.5rem;
                        }
                        @media screen and (min-width: 1200px) {
                            font-size: 1.125rem;
                            line-height: 1.5em;
                        }
                        br {
                            display: none;
                            @media screen and (min-width: 1400px) {
                                display: block;
                            }
                        }
                    }
                }
            }
        }
    }
}
</style>
