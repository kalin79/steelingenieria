<template>
    <AppLayout>
        <Hero :slides="banners" />
        <DatosSection :stats="statsData" />
        <article class="proyectoDetalle">
            <div class="container">
            <header v-if="banner" class="proyectoDetalle__banner">
                <picture>
                    <source
                        v-if="proyecto.bannerMobile"
                        media="(max-width: 768px)"
                        :srcset="proyecto.bannerMobile.url"
                    />
                    <!--
                        Es la imagen mas grande de la pantalla inicial, asi
                        que carga con prioridad alta y sin lazy: retrasarla
                        empeora directamente el LCP de la ficha.
                    -->
                    <img
                        :src="banner.url"
                        :alt="banner.alt || proyecto.title"
                        :width="banner.width || undefined"
                        :height="banner.height || undefined"
                        fetchpriority="high"
                        decoding="async"
                    />
                </picture>
            </header>
            </div>
            <div class="container">
                <!-- <nav class="proyectoDetalle__migas" aria-label="Ruta de navegación">
                    <Link href="/">Inicio</Link>
                    <span aria-hidden="true">/</span>
                    <Link href="/proyectos">Proyectos</Link>
                    <span aria-hidden="true">/</span>
                    <span aria-current="page">{{ proyecto.title }}</span>
                </nav> -->

                <div class="proyectoDetalle__layout">
                    <div class="proyectoDetalle__contenido">
                        <p v-if="proyecto.subtitle" class="proyectoDetalle__subtitulo">
                            {{ proyecto.subtitle }}
                        </p>
                        <h1>{{ proyecto.title }}</h1>
                        

                        <!--
                            HTML del editor enriquecido del panel. Es
                            contenido cargado por el equipo, no por un
                            visitante, asi que v-html es aceptable aca.
                        -->
                        <div
                            v-if="proyecto.description"
                            class="proyectoDetalle__texto"
                            v-html="proyecto.description"
                        ></div>

                        <div class="botonContainer">
                            <Link href="/proyectos">
                                <div class="centerFlex">
                                <img src="/images/btn2.png" />
                                <span>VER MÁS PROYECTOS</span>
                                </div>
                            </Link>
                        </div>
                    </div>

                    <aside v-if="tieneFicha" class="proyectoDetalle__ficha">
                        
                        <div class="gridFicha">
                            <div v-if="proyecto.client">
                                <h2>CLIENTE</h2>
                                <p>{{ proyecto.client }}</p>
                            </div>
                            <div v-if="proyecto.execution">
                                <h2>AÑO DE EJECUCIÓN</h2>
                                <p>{{ proyecto.execution }}</p>
                            </div>
                        </div>

                       
                    </aside>
                </div>

                <!-- <section v-if="relacionados.length" class="proyectoDetalle__relacionados">
                    <h2>Otros proyectos</h2>
                    <div class="proyectoDetalle__grid">
                        <ProyectoCard
                            v-for="item in relacionados"
                            :key="item.id"
                            :proyecto="item"
                        />
                    </div>
                </section> -->
            </div>
        </article>
        <ContactoComponent />
    </AppLayout>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import ProyectoCard from "@/Components/Proyectos/ProyectoCard.vue";
import Hero from "@/Components/Hero.vue";
import DatosSection from "@/Components/Home/Datos.vue";
import ContactoComponent from "@/Components/Share/Contacto.vue";
const props = defineProps({
    proyecto: { type: Object, required: true },
    relacionados: { type: Array, default: () => [] },
});

// Cae a la imagen de la tarjeta si no cargaron banner: mejor una cabecera
// con la portada que un hueco en blanco.
const banner = computed(
    () =>
        props.proyecto.bannerDesktop ||
        props.proyecto.bannerMobile ||
        props.proyecto.imageDesktop ||
        null,
);

const tieneFicha = computed(
    () => Boolean(props.proyecto.client || props.proyecto.execution),
);
const banners = [
    {
        id: 1,
        image: "/images/proyectoB.png",
        imageM: "/images/proyectoBM.png",
        title: "Proyectos de <br />Ingeniería",
        subtitle: "Detrás de cada proyecto hay experiencia y <br />compromiso",
        description: ``,
        boton: ``,
        link: ``,
    },
];
const statsData = [
    {
        id: 1,
        number: 15,
        suffix: "+",
        label: "Años de <br />Experiencia",
        duration: 2,
    },
    {
        id: 2,
        number: 500,
        suffix: "+",
        label: "Proyectos <br />Ejecutados",
        duration: 2.5,
    },
    {
        id: 3,
        number: 300,
        suffix: "+",
        label: "Clientes <br />Atendidos",
        duration: 2.5,
    },
];
</script>

<style lang="scss" scoped>
.proyectoDetalle {
    padding: 6rem 0 0 0;
    .botonContainer{
        margin-top: 4rem;
        margin-bottom: 1.5rem;

        @media screen and (min-width: 992px){
            margin-bottom: 0;
        }
        a {
            width: 100%;
            height: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 30px;
            cursor: pointer;
            background: $color-secondary;
            @media screen and (min-width: 992px) {
                width: 250px;
                height: 50px;
            }
            @media screen and (min-width: 1200px) {
                width: 264px;
                height: 60px;
            }
            .centerFlex{
                display: flex;
                justify-content: center;
                gap: .5rem;
                align-items: center;
            }
            img {
                width: 32px;
                height: 32px;
                flex: 0 32px;
            }
            span {
                flex: 1;
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
    &__banner {
        overflow: hidden;
        border-radius: 30px;
        margin-bottom: 1.5rem;
        img {
            width: 100%;
            height: clamp(260px, 45vw, 520px);
            object-fit: cover;
            display: block;
        }
    }

    &__migas {
        display: flex;
        flex-wrap: wrap;
        gap: $spacing-sm;
        padding: $spacing-lg 0;
        font-size: $font-size-sm;
        color: $color-accent;

        a {
            color: $color-primary;
            text-decoration: none;

            &:hover {
                text-decoration: underline;
            }
        }
    }

    &__layout {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1rem;
        padding-bottom: $spacing-3xl;

        @media screen and (min-width: 992px){
            grid-template-columns: repeat(12, 1fr);
        }
    }

    &__contenido {
        grid-column: 1 / -1;
        margin-top: 2.5rem;
        @media screen and (min-width: 992px){
            grid-column: 1 / span 6;
        }
        h1 {
            margin: 0 0 $spacing-md;
            font-size: 1.75rem;
            line-height: 1.05em;
            color: #1A1A1A;
            font-family: $font-sans;
            font-weight: 600;

            @media screen and (min-width: 992px) {
                font-size: 1.5rem;
                line-height: 1.35em;
            }
            @media screen and (min-width: 1200px) {
                font-size: 1.875rem;
                line-height: 1.15em;
            }
        }
    }

    &__subtitulo {
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

    // El contenido viene del editor enriquecido: los estilos se aplican a
    // las etiquetas que genera, no a clases que se puedan escribir ahi.
    &__texto {
        line-height: $line-height-relaxed;
        color: $color-text-light;

        :deep(h2),
        :deep(h3) {
            margin: $spacing-xl 0 $spacing-sm;
            color: $color-primary-dark;
            line-height: $line-height-tight;
        }

        :deep(p) {
            margin: 0 0 $spacing-md;
        }

        :deep(ul),
        :deep(ol) {
            margin: 0 0 $spacing-md;
            padding-left: $spacing-lg;
        }

        :deep(li) {
            margin-bottom: $spacing-xs;
        }

        :deep(a) {
            color: $color-primary;
        }

        :deep(blockquote) {
            margin: $spacing-lg 0;
            padding: $spacing-md $spacing-lg;
            border-left: 3px solid $color-secondary;
            background: $color-bg-alt;
        }

        :deep(img) {
            max-width: 100%;
            height: auto;
            border-radius: $radius-md;
        }
    }

    &__ficha {
        grid-column: 1 / -1;
        
        align-self: center;
        position: sticky;
        top: 8rem;
        padding: $spacing-lg;
        background: #253773;
        border-radius: $radius-md;
        box-shadow: $shadow-sm;
        width: 100%;
        @media screen and (min-width: 992px){
            grid-column: 7 / -1;
            width: 387px;
        }
        .gridFicha{
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            > div {
                &:nth-of-type(1){
                    flex: 0 0 150px;
                }
                &:nth-of-type(2){
                    flex: 1;
                }
            }
        }

        h2 {
            font-size: .9rem;
            line-height: 1.5em;
            color: #FFBB10;
            font-family: $font-sans;
            font-weight: 500;

            @media screen and (min-width: 992px) {
                font-size: .95rem;
                line-height: 1.5em;
            }
            @media screen and (min-width: 1200px) {
                font-size: 1rem;
                line-height: 1.5em;
            }
        }

        p {
            font-size: 1rem;
            line-height: 1.5em;
            color: #fff;
            font-family: $font-sans;
            font-weight: 500;

            @media screen and (min-width: 992px) {
                font-size: 1.05rem;
                line-height: 1.5em;
            }
            @media screen and (min-width: 1200px) {
                font-size: 1.125rem;
                line-height: 1.5em;
            }
        }

        

        @include respond-to("md") {
            position: static;
        }
    }

    &__cta {
        display: block;
        margin-top: $spacing-md;
        padding: $spacing-md;
        text-align: center;
        text-decoration: none;
        font-weight: $font-weight-semibold;
        color: $color-primary-dark;
        background: $color-secondary;
        border-radius: $radius-sm;

        &:hover {
            filter: brightness(0.95);
        }
    }

    &__relacionados {
        padding-bottom: $spacing-3xl;

        h2 {
            margin-bottom: $spacing-lg;
            color: $color-primary-dark;
        }
    }

    &__grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: $spacing-xl;

        @include respond-to("sm") {
            grid-template-columns: 1fr;
        }
    }
}
</style>
