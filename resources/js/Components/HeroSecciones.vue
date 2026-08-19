<!-- resources/js/Components/Hero/HeroSimple.vue -->
<script setup>
import { computed } from "vue";
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import "@splidejs/vue-splide/css"; // Estilos por defecto
import { Link } from "@inertiajs/vue3";

// RECIBIR PROPS del backend
const props = defineProps({
    slides: {
        type: Array,
        default: () => [
            // Fallback si no hay datos
            {
                id: 1,
                image: "/images/bs1.webp",
                imageM: "/images/bs1.webp",
                icono: "/images/kg.svg",
                kilos: `hasta 2,000 kg.`,
                title: "smartMover",
                subtitle: "",
                description: `Remolcadores eléctricos pequeños pero potentes para eliminar la manipulación manual.`,
                boton: ``,
                link: ``,
            },
        ],
    },
});

// Validar que tenemos slides
const heroSlides = computed(() => {
    return props.slides && props.slides.length > 0
        ? props.slides
        : [
              {
                  id: 1,
                  image: "/images/bs1.webp",
                  imageM: "/images/bs1.webp",
                  icono: "/images/kg.svg",
                  kilos: `hasta 2,000 kg.`,
                  title: "smartMover",
                  subtitle: "",
                  description: `Remolcadores eléctricos pequeños pero potentes para eliminar la manipulación manual.`,
                  boton: ``,
                  link: ``,
              },
          ];
});

// Opciones de Splide (fácil de entender)
const options = {
    type: "fade",
    rewind: true,
    perPage: 1,
    autoplay: true,
    interval: 5000,
    pauseOnHover: true,
    pauseOnFocus: true,
    arrows: false, // flechas
    pagination: true, // puntos
    speed: 600,
    gap: 0,
};
</script>

<template>
    <section class="sliderContainerHero">
        <Splide :options="options" class="itemContainer">
            <SplideSlide
                v-for="(slide, index) in slides"
                :key="slide.id || index"
                class="hero__slide"
            >
                <picture class="hero__picture">
                    <!-- Usar imagen del backend -->
                    <source
                        media="(min-width: 768px)"
                        :srcset="`${slide.image}?format=webp`"
                        type="image/webp"
                    />
                    <source
                        media="(min-width: 768px)"
                        :srcset="slide.image"
                        type="image/jpeg"
                    />

                    <!-- Mobile (< 768px) -->
                    <source
                        media="(max-width: 767px)"
                        :srcset="`${slide.imageM}?format=webp`"
                        type="image/webp"
                    />
                    <source
                        media="(max-width: 767px)"
                        :srcset="slide.imageM"
                        type="image/jpeg"
                    />
                    <!-- Fallback -->
                    <img
                        :src="slide.image"
                        :alt="slide.title"
                        class="hero__image"
                        :loading="index === 0 ? 'eager' : 'lazy'"
                        decoding="async"
                        width="1920"
                        height="1080"
                    />
                </picture>

                <div class="hero__overlay"></div>

                <div class="hero__content">
                    <div class="hero__text">
                        <!-- Contenido dinámico -->
                        <div class="headerBox">
                            <div class="imgBox">
                                <img :src="slide.icono" />
                            </div>
                            <p v-html="slide.kilos"></p>
                        </div>
                        <h1 v-if="index === 0" v-html="slide.title"></h1>
                        <h3 v-else v-html="slide.title"></h3>
                        <p v-html="slide.description"></p>
                    </div>
                </div>
            </SplideSlide>
        </Splide>
    </section>
</template>
<style lang="scss">
.sliderContainerHero {
    .splide__track {
        height: 100%;
    }
    .hero__actions {
        // border: 2px solid red;
        margin-top: 2rem;
        a {
            width: 200px;
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
    }
    .hero__text {
        .headerBox {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 0.5rem;
            .imgBox {
                flex: 0 0 58px;
                img {
                    object-fit: contain;
                    width: auto;
                    height: auto;
                }
            }
            p {
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
        }
        h2 {
            font-family: $font-archia;
            font-weight: 500;
            font-size: 1em;
            color: $color-secondary;
            @media screen and (min-width: 992px) {
                font-size: 1.175em;
            }
            @media screen and (min-width: 1200px) {
                font-size: 1.375em;
            }
        }

        h1,
        h3 {
            font-family: $font-archia;
            font-weight: 500;
            font-size: 3rem;
            line-height: 1em;
            color: $color-secondary;
            margin: 1rem 0;
            @media screen and (min-width: 992px) {
                font-size: 4.5rem;
                line-height: 1em;
            }
            @media screen and (min-width: 1200px) {
                font-size: 3.75rem;
                line-height: 1em;
            }
            @media screen and (min-width: 1600px) {
                font-size: 5.75rem;
                line-height: 1em;
            }
        }
        p {
            font-family: $font-sans;
            font-weight: 500;
            font-size: 1rem;
            line-height: 1.5em;
            color: white;
            @media screen and (min-width: 992px) {
                font-size: 1.025rem;
                line-height: 1.5em;
            }
            @media screen and (min-width: 1200px) {
                font-size: 1.125rem;
                line-height: 1.5em;
            }
            br {
                display: none;
                @media screen and (min-width: 992px) {
                    display: block;
                }
            }
        }
    }
}
</style>
<style lang="scss" scoped>
// aspect-ratio: 16 / 9;   // Panorámico (video)
// aspect-ratio: 4 / 3;    // TV clásica
// aspect-ratio: 3 / 2;    // Fotos
// aspect-ratio: 1 / 1;    // Cuadrado
// aspect-ratio: 9 / 16;   // Vertical (mobile)
.sliderContainerHero {
    position: relative;
    width: 100%;
    height: 700px;

    // Cuando altura viewport < 500px
    @media screen and (min-height: 499px) {
        height: 700px;
    }

    @media screen and (min-width: 768px) {
        height: 700px;
    }
    @media (min-width: 992px) {
        height: 750px;
    }
    @media screen and (min-width: 1200px) {
        height: 750px;
    }
    @media screen and (min-width: 1200px) and (min-height: 750px) {
        height: 95vh;
    }

    .splide__slide {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: flex-start;
        padding-bottom: 6rem;
        @media screen and (min-width: 992px) {
            justify-content: center;
            padding-bottom: 0rem;
        }
        .hero__overlay {
            position: absolute;
            z-index: 6;
            top: 0;
            left: 0;
            background: rgba(black, 0.5);
            width: 100%;
            height: 100%;
        }
        .hero__content {
            // border: 1px solid red;
            position: relative;
            z-index: 10;
            max-width: $max-width-container;
            margin: 0 auto;
            padding: 0 $spacing-md;
            width: 100%;
        }
        .hero__picture {
            height: 100%;
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 5;
            // border: 1px solid red;
            .hero__image {
                height: 100%;
                width: 100%;
                aspect-ratio: 9 / 16;
                @media screen and (min-width: 992px) {
                    aspect-ratio: 16 / 9;
                }
            }
        }
    }
}

.itemContainer {
    height: 100%;
    width: 100%;
}
/* ==================== FLECHAS ==================== */
:deep(.splide__arrow) {
    background: rgba(255, 255, 255, 0.9);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    color: #1f2937;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease; /* Mantengo la transición suave */
}

/* Posición de las flechas */
:deep(.splide__arrow--prev) {
    left: 20px;
}
:deep(.splide__arrow--next) {
    right: 20px;
}

/* Opcional: Si quieres que cambie un poco al hover (solo opacidad) */
:deep(.splide__arrow:hover) {
    background: rgba(255, 255, 255, 1); /* Solo se pone más blanco */
}

/* ==================== PAGINACIÓN ==================== */
:deep(.splide__pagination) {
    bottom: 30px;
    gap: 10px;
}

:deep(.splide__pagination__page) {
    width: 12px;
    height: 12px;
    background: rgba(255, 255, 255, 0.6);
    border: 2px solid white;
    border-radius: 50%;
    transition: all 0.3s ease;

    &:hover {
        background: rgba(255, 255, 255, 0.85);
    }
}

:deep(.splide__pagination__page.is-active) {
    background: white;
    width: 34px;
    border-radius: 9999px;
}
</style>
