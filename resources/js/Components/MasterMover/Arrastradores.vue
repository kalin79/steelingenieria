<template>
    <section class="arrastradorSection">
        <div class="bg"></div>
        <div class="container">
            <div class="layoutContainer">
                <div>
                    <div class="etiquetaContainer">
                        <span>Arrastradores Eléctricos</span>
                    </div>
                    <h2>Descubra un manejo de materiales más seguro</h2>
                    <p>
                        Los remolcadores eléctricos ofrecen un movimiento seguro
                        y controlado de cargas pesadas con ruedas. Gracias a su
                        diseño compacto y a que no requieren licencia para su
                        operación, eliminan la manipulación manual, protegen a
                        los operadores y mejoran la eficiencia operativa.
                    </p>
                    <div class="accordionContainer">
                        <div class="accordion">
                            <div
                                v-for="(item, index) in items"
                                :key="index"
                                class="accordion__item"
                                :class="{
                                    'accordion__item--open':
                                        openIndex === index,
                                }"
                            >
                                <button
                                    class="accordion__header"
                                    @click="toggleItem(index)"
                                    :aria-expanded="openIndex === index"
                                    :aria-controls="`accordion-content-${index}`"
                                >
                                    <span class="accordion__title">{{
                                        item.title
                                    }}</span>
                                    <svg
                                        class="accordion__icon"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <polyline
                                            points="6 9 12 15 18 9"
                                        ></polyline>
                                    </svg>
                                </button>

                                <div
                                    :id="`accordion-content-${index}`"
                                    class="accordion__content"
                                    :ref="`content-${index}`"
                                >
                                    <div class="accordion__body">
                                        {{ item.content }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { ref } from "vue";
import gsap from "gsap";
const items = [
    {
        title: "¿Cómo funcionan?",
        content: `Al conectarse de forma segura a la carga con ruedas, los remolcadores eléctricos suelen ser operados por peatones, pero también pueden ser controlados de forma remota, lo que permite al operador alejarse para obtener una mejor visibilidad.`,
    },
    {
        title: "¿Qué industrias utilizan remolcadores eléctricos?",
        content: `Una amplia gama de industrias utiliza nuestros remolcadores eléctricos para mejorar la seguridad en el trabajo e impulsar la eficiencia. Desde el movimiento de contenedores de residuos en la gestión de instalaciones hasta el traslado de motores aeronáuticos en mantenimiento, nuestras soluciones de remolque se utilizan de forma fiable una y otra vez.
Muchos de nuestros clientes operan en entornos de fabricación industrial como construcción, minería, equipos agrícolas, fabricación farmacéutica, energía, automoción y aeroespacial.`,
    },
    {
        title: "¿Qué tipos están disponibles?",
        content: `MasterMover cuenta con una amplia gama de máquinas diseñadas para mejorar la manipulación de cargas pesadas con ruedas.
La gama SmartMover es la solución ideal de manipulación manual para mover cargas de hasta 2.000 kg. Con un diseño compacto y una variedad de opciones de acoplamiento seguras, la gama SmartMover se utiliza a menudo para mecanizar el movimiento de cargas que antes se manipulaban manualmente, reduciendo el riesgo de lesiones.
Para cargas de hasta 20.000 kg, nuestras gamas MasterTug y MasterTow ofrecen un rendimiento potente y permiten que un solo operario mueva fácilmente cargas sobre ruedas o raíles.`,
    },
    {
        title: "¿Cómo se conectan a una carga?",
        content: `Es importante considerar cómo los remolcadores eléctricos se conectarán a su carga; los sistemas de acoplamiento garantizan una conexión segura y ayudan a determinar la maniobrabilidad y la tracción. Nuestros expertos en producto le ayudarán a especificar el acoplamiento adecuado para su aplicación.`,
    },
];
const openIndex = ref(null);
const toggleItem = (index) => {
    if (openIndex.value === index) {
        // Cerrar
        closeItem(index);
        openIndex.value = null;
    } else {
        // Si no permite múltiples, cerrar el anterior
        if (!items.allowMultiple && openIndex.value !== null) {
            closeItem(openIndex.value);
        }

        // Abrir el nuevo
        openItem(index);
        openIndex.value = index;
    }
};
const openItem = (index) => {
    const content = document.getElementById(`accordion-content-${index}`);
    if (!content) return;

    // Animación de apertura con GSAP
    gsap.to(content, {
        height: "auto",
        duration: 0.3,
        ease: "power2.out",
    });
};
const closeItem = (index) => {
    const content = document.getElementById(`accordion-content-${index}`);
    if (!content) return;

    // Animación de cierre con GSAP
    gsap.to(content, {
        height: 0,
        duration: 0.3,
        ease: "power2.in",
    });
};
</script>
<style lang="scss" scope>
.arrastradorSection {
    background-image: url("/images/f2.webp");
    background-position: top right;
    background-size: contain;
    background-repeat: repeat;
    position: relative;
    .bg {
        background-image: url("/images/f3.webp");
        background-position: 0 0;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        position: absolute;
        top: 0;
        left: 0;
        width: 45%;
        height: 100%;
    }
    .container {
        position: relative;
        z-index: 2;
        .layoutContainer {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1rem;
            padding: 5rem 0;
            > div {
                grid-column: 7 / -1;
                .accordion {
                    width: 100%;
                    border: 0px solid $color-border;
                    border-radius: $radius-lg;
                    overflow: hidden;
                }

                .accordion__item {
                    border-bottom: 1px solid #bababa;

                    &:last-child {
                        border-bottom: none;
                    }

                    &--open {
                        .accordion__header {
                            background: rgba($color-primary, 0.05);
                        }

                        .accordion__icon {
                            transform: rotate(180deg);
                        }
                    }
                }

                .accordion__header {
                    width: 100%;
                    padding: $spacing-md;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    gap: $spacing-md;
                    background: transparent;
                    border: none;
                    cursor: pointer;
                    transition: background $transition-fast;
                    font-family: $font-sans;
                    font-weight: $font-weight-semibold;
                    font-size: $font-size-base;
                    color: $color-text-light;
                    text-align: left;

                    @include respond-to("sm") {
                        padding: $spacing-sm;
                        font-size: $font-size-sm;
                    }

                    &:hover {
                        background: rgba($color-primary, 0.03);
                    }
                }

                .accordion__title {
                    flex: 1;
                    font-size: 1rem;
                    line-height: 1.5em;
                    color: $color-text-light;
                    font-family: $font-sans;
                    font-weight: 600;
                    margin: 1rem 0 0.5rem;
                    @media screen and (min-width: 992px) {
                        font-size: 1rem;
                        line-height: 1.5em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1.125rem;
                        line-height: 1.4em;
                    }
                }

                .accordion__icon {
                    flex-shrink: 0;
                    transition: transform $transition-base;
                    color: #1d1d1d;
                }

                .accordion__content {
                    height: 0;
                    overflow: hidden;
                }

                .accordion__body {
                    padding: 0 $spacing-md $spacing-md;
                    font-family: $font-sans;
                    font-size: $font-size-base;
                    line-height: $line-height-relaxed;
                    color: $color-text-light;

                    @include respond-to("sm") {
                        padding: 0 $spacing-sm $spacing-sm;
                        font-size: $font-size-sm;
                    }
                }
                h2 {
                    font-size: 1.5rem;
                    line-height: 1.15em;
                    color: $color-text-light;
                    font-family: $font-sans;
                    font-weight: 400;
                    margin: 1rem 0 0.5rem;
                    @media screen and (min-width: 992px) {
                        font-size: 1.65rem;
                        line-height: 1em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1.875rem;
                        line-height: 1em;
                    }
                }
                p {
                    font-size: 1rem;
                    line-height: 1.5em;
                    color: $color-text-light;
                    font-family: $font-sans;
                    font-weight: 400;
                    margin: 1rem 0 0.5rem;
                    @media screen and (min-width: 992px) {
                        font-size: 1rem;
                        line-height: 1.5em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1.125rem;
                        line-height: 1.4em;
                    }
                }
                .etiquetaContainer {
                    border: 1px solid $color-primary-light;
                    border-radius: 30px;
                    min-width: 216px;
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
            }
        }
    }
}
</style>
