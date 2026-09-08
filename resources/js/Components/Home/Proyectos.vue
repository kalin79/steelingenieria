<template>
    <section v-if="proyectos.length" class="sectionProyectos">
        <!-- <div class="bgSocio"></div> -->
        <div class="container">
            <div class="layoutContainer">
                <div>
                    <div class="etiquetaContainer">
                        <span>Proyectos</span>
                    </div>
                    <div class="titularContainer">
                        <h2>
                            Nuestra experiencia se <br />
                            refleja en cada proyecto
                        </h2>
                    </div>
                </div>
                <div>
                    <div class="descriptionContainer">
                        <p>
                            Desarrollamos soluciones de ingeniería, fabricación
                            y montaje para los sectores industrial, minero,
                            energético y logístico, garantizando calidad,
                            seguridad y resultados que generan valor para
                            nuestros clientes.
                        </p>
                    </div>
                </div>
                <div>
                    <div class="galleryProyectos">
                        <Splide
                            ref="splideRef"
                            :options="options"
                            @splide:mounted="onMounted"
                        >
                            <SplideSlide
                                v-for="proyecto in proyectos"
                                :key="proyecto.id"
                                class="carrusel__slide"
                            >
                                <Link :href="proyecto.url" class="cardProyect">
                                    <div class="cardHeader">
                                        <!--
                                            Dos archivos distintos, no el
                                            mismo escalado: el navegador
                                            descarga solo el que va a
                                            mostrar segun el ancho.
                                        -->
                                        <picture v-if="proyecto.imageDesktop">
                                            <source
                                                v-if="proyecto.imageMobile"
                                                media="(max-width: 640px)"
                                                :srcset="proyecto.imageMobile.url"
                                            />
                                            <img
                                                :src="proyecto.imageDesktop.url"
                                                :alt="
                                                    proyecto.imageDesktop.alt ||
                                                    proyecto.title
                                                "
                                                loading="lazy"
                                                decoding="async"
                                            />
                                        </picture>
                                    </div>
                                    <div class="cardBody">
                                        <h3 v-if="etiqueta(proyecto)">
                                            {{ etiqueta(proyecto) }}
                                        </h3>
                                        <h2>{{ proyecto.title }}</h2>
                                    </div>
                                </Link>
                            </SplideSlide>
                        </Splide>
                    </div>
                    <div class="botonContainer">
                        <Link href="/proyectos">
                            <span>VER TODOS LOS PROYECTOS</span>
                        </Link>
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
const splideRef = ref(null);
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
/*
 * Los proyectos llegan del controlador, no se escriben aca.
 * Formato: Project::toCardPayload() en el modelo.
 */
defineProps({
    proyectos: { type: Array, default: () => [] },
});

/*
 * La linea superior de la tarjeta.
 *
 * El diseno original decia "Sector Minero", pero la tabla de proyectos no
 * tiene una columna sector: se usa el subtitulo, que es el campo libre
 * donde el editor puede escribir justamente eso, y si esta vacio cae al
 * cliente. Si esa etiqueta va a ser siempre un sector cerrado, conviene
 * una columna propia en vez de reutilizar el subtitulo.
 */
const etiqueta = (proyecto) => proyecto.subtitle || proyecto.client || null;

const onMounted = () => {
    document.fonts?.ready.then(() => splideRef.value?.splide.refresh());
};
</script>
<style lang="scss">
.galleryProyectos {
    width: 100%;
    min-width: 0;
    .cardProyect {
        // Ahora es un enlace al detalle, no un div: sin esto hereda el
        // subrayado y el color de enlace, y no ocupa todo el ancho.
        display: block;
        text-decoration: none;
        color: inherit;
        height: 100%;
        border-radius: 20px;
        overflow: hidden;
        padding: 1.5rem 1.5rem 3.5rem;
        background: $color-primary-dark;
        transition: transform 0.25s ease;

        &:hover,
        &:focus-visible {
            transform: translateY(-4px);
        }
        .cardHeader {
            border-radius: 10px;
            overflow: hidden;
            height: 260px;
            width: 100%;
            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
            }
        }
        .cardBody {
            margin-top: 1.5rem;
            h2 {
                font-size: 1rem;
                line-height: 1.35em;
                color: white;
                font-family: $font-sans;
                font-weight: 600;

                @media screen and (min-width: 992px) {
                    font-size: 1rem;
                    line-height: 1.35em;
                }
                @media screen and (min-width: 1200px) {
                    font-size: 1.15rem;
                    line-height: 1.35em;
                }
            }
            h3 {
                font-size: 0.875rem;
                line-height: 1.5em;
                color: $color-secondary;
                font-family: $font-sans;
                font-weight: 600;
                margin-bottom: 0.25rem;
                text-transform: uppercase;
                @media screen and (min-width: 992px) {
                    font-size: 0.875rem;
                    line-height: 1.5em;
                }
                @media screen and (min-width: 1200px) {
                    font-size: 0.875rem;
                    line-height: 1.5em;
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
.sectionProyectos {
    background: white;
    position: relative;
    z-index: 9;
    padding: 4rem 0 5rem;
    @media screen and (min-width: 992px) {
        padding: 8rem 0 5rem;
    }
    .container {
        position: relative;
        z-index: 10;
    }
    .bgSocio {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background-image: url("/images/bg.webp");
        background-position: 0 0;
        background-repeat: repeat;
        background-size: contain;
    }
    .layoutContainer {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        padding: 0.5rem 0 3rem;
        gap: 0.5rem;
        @media screen and (min-width: 992px) {
            gap: 1rem;
            padding: 1rem 0 3rem;
        }
        > div {
            &:nth-of-type(3) {
                grid-column: 1 / -1;
                display: block; // <- el flex no aportaba nada y colapsaba el ancho
                margin-top: 3rem;
                @media screen and (min-width: 992px) {
                    margin-top: 5rem;
                }
                .botonContainer {
                    display: flex;
                    justify-content: flex-end;
                    // border: 1px solid red;
                    margin-top: 4rem;
                    a {
                        width: 100%;
                        height: 50px;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                        border-radius: 30px;
                        background: $color-secondary;
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
                            font-size: 0.875rem;
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
                }
            }
            &:nth-of-type(2) {
                grid-column: 1 / -1;
                @media screen and (min-width: 992px) {
                    grid-column: 7 / -1;
                }
                .descriptionContainer {
                    padding-top: 0.5rem;
                    @media screen and (min-width: 992px) {
                        padding-top: 4.95rem;
                    }
                    @media screen and (min-width: 1200px) {
                        padding-top: 5rem;
                    }
                    p {
                        font-size: 1rem;
                        line-height: 1.35em;
                        color: $color-text-light;
                        font-family: $font-sans;
                        font-weight: 400;
                        @media screen and (min-width: 992px) {
                            font-size: 1rem;
                            line-height: 1.35em;
                        }
                        @media screen and (min-width: 1200px) {
                            font-size: 1.125rem;
                            line-height: 1.5em;
                        }
                        span {
                            color: $color-primary-light;
                        }
                    }
                }
            }
            &:nth-of-type(1) {
                grid-column: 1 / -1;
                @media screen and (min-width: 992px) {
                    grid-column: 1 / span 6;
                }
                .etiquetaContainer {
                    border: 1px solid $color-primary-light;
                    border-radius: 30px;
                    min-width: 171px;
                    height: 34px;
                    display: inline-block;
                    text-align: center;
                    span {
                        font-size: 0.9rem;
                        line-height: 2.35em;
                        color: $color-primary-light;
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
                    margin: 1.5rem 0 0;
                    @media screen and (min-width: 992px) {
                        margin: 1.5rem 0;
                    }
                    h2 {
                        line-height: 1.15em;
                        font-size: 2rem;
                        color: $color-text-light;
                        font-family: $font-archia;
                        font-weight: 500;

                        @media screen and (min-width: 992px) {
                            line-height: 1.15em;
                            font-size: 2rem;
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
