<template>
    <div class="galeriaSection">
        <div class="container">
            <div class="headerContainer">
                <div>
                    <h2 v-html="galerias.titulo"></h2>
                </div>
            </div>
            <div class="bodyContainer">
                <div class="galeria">
                    <ul class="galeria__grid">
                        <li
                            v-for="(item, index) in galerias.fotos"
                            :key="index"
                            class="galeria__item"
                            :class="{
                                'galeria__item--destacado': item.destacado,
                            }"
                        >
                            <img
                                class="galeria__img"
                                :src="item.imagen"
                                :alt="item.alt"
                                :loading="prioridad ? 'eager' : 'lazy'"
                                :fetchpriority="
                                    prioridad && item.destacado
                                        ? 'high'
                                        : 'auto'
                                "
                                decoding="async"
                            />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
// RECIBIR PROPS del backend
const props = defineProps({
    galerias: {
        type: Object,
    },
});
</script>
<style lang="scss" scoped>
.galeriaSection {
    padding: 2rem 0 2rem;
    background: #fff;
    .bodyContainer {
        margin-top: 2rem;
        .galeria {
            &__titulo {
                font-family: $font-red;
                font-size: $font-size-3xl;
                font-weight: $font-weight-bold;
                color: $color-text;
                text-align: center;
                margin-bottom: $spacing-xl;
                line-height: $line-height-tight;
            }

            &__grid {
                display: grid;
                grid-template-columns: 1fr 1.45fr 1fr;
                grid-template-rows: repeat(2, minmax(0, 1fr));
                gap: $spacing-sm;

                // Fija la altura del bloque antes de que carguen las imágenes.
                // Sin esto el grid colapsa a cero y provoca desplazamiento de layout.
                aspect-ratio: 632 / 340;

                list-style: none;
                margin: 0;
                padding: 0;
                @media screen and (min-width: 992px) {
                    grid-template-columns: 3fr 4fr 4fr;
                }
            }

            &__item {
                position: relative;
                overflow: hidden;
                border-radius: 20px;
                background: $color-border;

                &--destacado {
                    grid-column: 2;
                    grid-row: 1 / span 2;
                }
            }

            &__img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform $transition-base;
            }

            &__item:hover &__img {
                transform: scale(1.04);
            }

            // Respeta la preferencia del sistema de reducir movimiento.
            @media (prefers-reduced-motion: reduce) {
                &__img {
                    transition: none;
                }

                &__item:hover &__img {
                    transform: none;
                }
            }

            @include respond-to("md") {
                padding: $spacing-xl $spacing-md;

                &__titulo {
                    font-size: $font-size-2xl;
                    margin-bottom: $spacing-lg;
                }

                &__grid {
                    grid-template-columns: repeat(2, 1fr);
                    grid-template-rows: none;
                    aspect-ratio: auto;
                }

                &__item {
                    aspect-ratio: 4 / 3;

                    &--destacado {
                        grid-column: 1 / -1;
                        grid-row: auto;
                        aspect-ratio: 16 / 10;
                    }
                }
            }
        }
    }
    .headerContainer {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;

        > div {
            &:nth-of-type(1) {
                h2 {
                    font-size: 1.5rem;
                    line-height: 1.15em;
                    color: #000;
                    font-family: $font-archia;
                    font-weight: 500;
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
            }
        }
    }
}
</style>
