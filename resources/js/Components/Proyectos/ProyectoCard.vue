<template>
    <Link :href="proyecto.url" class="proyectoCard">
        <div class="proyectoCard__media">
            <!--
                Dos archivos distintos, no el mismo escalado: el navegador
                elige por media query y descarga solo el que va a mostrar.
                width y height reservan el espacio antes de que la imagen
                llegue, que es lo que evita que la grilla salte al cargar.
            -->
            <picture v-if="imagen">
                <source
                    v-if="proyecto.imageMobile"
                    media="(max-width: 768px)"
                    :srcset="proyecto.imageMobile.url"
                />
                <img
                    :src="imagen.url"
                    :alt="imagen.alt || proyecto.title"
                    :width="imagen.width || undefined"
                    :height="imagen.height || undefined"
                    loading="lazy"
                    decoding="async"
                />
            </picture>
            <div v-else class="proyectoCard__placeholder" aria-hidden="true"></div>
        </div>

        <div class="proyectoCard__body">
            <div>
            <p v-if="proyecto.subtitle" class="proyectoCard__subtitulo">
                {{ proyecto.subtitle }}
            </p>
           
            <h3 class="proyectoCard__titulo">{{ proyecto.title }}</h3>
            </div>
            <div>
                <img src="/images/circulo.png" />
            </div>
        </div>
    </Link>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    proyecto: { type: Object, required: true },
});

// Si no cargaron la version movil, la de escritorio cubre los dos casos.
const imagen = computed(
    () => props.proyecto.imageDesktop || props.proyecto.imageMobile || null,
);
</script>

<style lang="scss" scoped>
.proyectoCard {
    display: flex;
    flex-direction: column;
    background: #253773;
    border-radius: 30px;
    padding: 1.25rem 1.25rem;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    box-shadow: $shadow-sm;
    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease;

    &:hover,
    &:focus-visible {
        transform: translateY(-4px);
        box-shadow: $shadow-lg;
    }

    &__media {
        // aspect-ratio: 3 / 2;
        width: 100%;
        height: 330px;
        overflow: hidden;
        background: $color-bg-alt;
        border-radius: 20px;
        picture{
            height: 100%;
        }
        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }
    }

    &:hover &__media img {
        transform: scale(1.04);
    }

    &__placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, $color-bg-alt, $color-border);
    }

    &__body {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 1rem;
        padding: 2rem 0;
        > div {
            &:nth-of-type(2){
                flex: 0 0 32px;

            }
            &:nth-of-type(1){
                flex: 1;
                
            }
        }
    }

    &__cliente {
        font-size: $font-size-xs;
        font-weight: $font-weight-semibold;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: $color-primary;
    }

    &__titulo {
        margin: 0;
        font-size: $font-size-xl;
        line-height: $line-height-tight;
        color: #fff;
    }

    &__subtitulo {
        margin: 0;
        font-size: $font-size-sm;
        line-height: $line-height-base;
        color: #FFBB10;
    }

    &__ejecucion {
        margin-top: $spacing-xs;
        font-size: $font-size-xs;
        color: $color-accent;
    }
}
</style>
