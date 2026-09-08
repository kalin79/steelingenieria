<template>
    <AppLayout>
        <Hero :slides="banners" />
        <DatosSection :stats="statsData" />
        <section class="proyectosListado">
             <div class="bgSocio"></div>
            <div class="container">
                <header class="proyectosListado__header">
                    <div>
                        <div class="etiquetaContainer">
                            <span>Proyectos</span>
                        </div>
                        <div class="titularContainer">
                            <h2>
                               Proyectos que demuestran <br />nuestra ingeniería
                            </h2>
                        </div>
                    </div>
                    <div>
                        <div class="descriptionContainer">
                            <p>
                                Cada proyecto refleja la experiencia, precisión y compromiso de nuestro equipo. Integramos ingeniería, diseño, fabricación y montaje para crear soluciones confiables, eficientes y adaptadas a los desafíos de cada industria.
                            </p>
                        </div>
                    </div>
                </header>

                <div v-if="proyectos.length" class="proyectosListado__grid">
                    <ProyectoCard
                        v-for="proyecto in proyectos"
                        :key="proyecto.id"
                        :proyecto="proyecto"
                    />
                </div>

                <p v-else class="proyectosListado__vacio">
                    Estamos preparando esta sección. Escríbenos y te contamos
                    sobre los proyectos que hemos ejecutado.
                </p>
            </div>
        </section>
        <ContactoComponent />
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ProyectoCard from "@/Components/Proyectos/ProyectoCard.vue";
import Hero from "@/Components/Hero.vue";
import DatosSection from "@/Components/Home/Datos.vue";
import ContactoComponent from "@/Components/Share/Contacto.vue";

defineProps({
    // El controlador siempre manda el arreglo; el default cubre el caso
    // de renderizar el componente suelto en una prueba.
    proyectos: { type: Array, default: () => [] },
});
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
.proyectosListado {
    padding: $spacing-3xl 0;
    position: relative;
    .bgSocio {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background-image: url("/images/bg2.png");
        background-position: 0 0;
        background-repeat: repeat;
        background-size: contain;
    }
    .container {
        position: relative;
        z-index: 10;
    }
    &__header {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        padding: 0.5rem 0 3rem;
        gap: 0.5rem;
        @media screen and (min-width: 992px) {
            gap: 1rem;
            padding: 1rem 0 3rem;
        }
        > div {
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
                        font-size: 1.95rem;
                        color: $color-text-light;
                        font-family: $font-archia;
                        font-weight: 500;

                        @media screen and (min-width: 992px) {
                            line-height: 1.35em;
                            font-size: 1.85rem;
                        }
                        @media screen and (min-width: 1200px) {
                            line-height: 1.25em;
                            font-size: 2.325rem;
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

    &__grid {
        display: grid;
        // auto-fill con minmax: el numero de columnas lo decide el ancho
        // disponible, sin escribir un breakpoint por cada tamano.
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: $spacing-xl;

        @include respond-to("sm") {
            grid-template-columns: 1fr;
            gap: $spacing-lg;
        }
    }

    &__vacio {
        padding: $spacing-2xl 0;
        color: $color-accent;
    }
}
</style>
