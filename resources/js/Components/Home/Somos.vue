<template>
    <section class="sectionSomos">
        <div class="container">
            <div class="layoutContainer">
                <div>
                    <div class="etiquetaContainer">
                        <span>¿Quienes Somos?</span>
                    </div>
                    <div class="titularContainer">
                        <h2>
                            Somos <strong>STEEL Ingeniería</strong>, una empresa
                            peruana <br />
                            especializada en el desarrollo y ejecución de <br />
                            <span>soluciones industriales integrales.</span>
                        </h2>
                    </div>
                    <div class="botonContainer">
                        <Link href=""><span>MÁS SOBRE NOSOTROS</span></Link>
                    </div>
                </div>
                <div>
                    <div class="centerContainer">
                        <div class="imagesContainer">
                            <image src="/images/s1.webp" />
                            <image src="/images/s2.webp" />
                            <image src="/images/s3.webp" />
                        </div>
                        <div class="infoContainer">
                            <p>
                                Reunimos a un equipo multidisciplinario de
                                ingenieros, técnicos y especialistas que
                                diseñan, fabrican e implementan proyectos con
                                los más altos estándares de calidad, seguridad e
                                innovación.
                            </p>
                        </div>
                    </div>
                    <div class="botonContainer">
                        <Link href=""><span>MÁS SOBRE NOSOTROS</span></Link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";

const onMounted = () => {
    document.fonts?.ready.then(() => splideRef.value?.splide.refresh());
};
</script>
<style lang="scss" scoped>
.sectionSomos {
    background-image: url("/images/fondosomos.webp");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    .layoutContainer {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1rem;
        padding: 3rem 0 6rem;
        @media screen and (min-width: 992px) {
            grid-template-columns: repeat(2, 1fr);
            padding: 5rem 0 8rem;
        }
        .botonContainer {
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
                    width: 220px;
                    height: 50px;
                }
                @media screen and (min-width: 1200px) {
                    width: 264px;
                    height: 60px;
                }
                span {
                    font-family: $font-red;
                    font-weight: bold;
                    font-size: 0.8rem;
                    line-height: 1.5em;
                    color: $color-text2;
                    @media screen and (min-width: 992px) {
                        font-size: 0.8rem;
                        line-height: 1.5em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 0.875rem;
                        line-height: 1.5em;
                    }
                }
            }
        }
        > div {
            &:nth-of-type(2) {
                padding-top: 0.5rem;
                @media screen and (min-width: 992px) {
                    padding-top: 7.5rem;
                }
                .botonContainer {
                    margin: 3rem auto 0;
                    display: flex;
                    justify-content: center;
                    @media screen and (min-width: 992px) {
                        display: none;
                    }
                    a {
                        width: 80%;
                    }
                }
                .infoContainer {
                    // border: 1px solid red;
                    p {
                        line-height: 1.5em;
                        font-size: 0.95em;
                        color: $color-text-light;
                        font-family: $font-sans;
                        font-weight: 400;
                        @media screen and (min-width: 992px) {
                            line-height: 1.5em;
                            font-size: 0.95em;
                        }
                        @media screen and (min-width: 1200px) {
                            line-height: 1.5em;
                            font-size: 1.125em;
                        }
                    }
                }
                .imagesContainer {
                    margin-bottom: 1.5rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    flex-flow: wrap;
                    gap: 0.5rem;
                    @media screen and (min-width: 992px) {
                        justify-content: flex-start;
                        gap: 1rem;
                    }
                    img {
                        max-width: 100px;
                        height: auto;
                        object-fit: contain;
                        @media screen and (min-width: 992px) {
                            max-width: 152px;
                        }
                    }
                }
            }
            &:nth-of-type(1) {
                .etiquetaContainer {
                    border: 1px solid $color-primary;
                    border-radius: 30px;
                    min-width: 171px;
                    height: 34px;
                    display: inline-block;
                    text-align: center;
                    span {
                        font-size: 0.9rem;
                        line-height: 2.35em;
                        color: $color-primary;
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

                .botonContainer {
                    display: none;
                    @media screen and (min-width: 992px) {
                        display: block;
                    }
                }

                .titularContainer {
                    margin: 1.5rem 0 0.5rem;
                    @media screen and (min-width: 992px) {
                        margin: 1.5rem 0;
                    }
                    h2 {
                        line-height: 1.25em;
                        font-size: 1.4rem;
                        color: $color-text-light;
                        font-family: $font-sans;
                        font-weight: 400;

                        @media screen and (min-width: 992px) {
                            line-height: 1.4em;
                            font-size: 1.5rem;
                        }
                        @media screen and (min-width: 1200px) {
                            line-height: 1.25em;
                            font-size: 1.875rem;
                            letter-spacing: -0.03em;
                        }
                        @media screen and (min-width: 1400px) {
                            letter-spacing: 0;
                        }
                        br {
                            display: none;
                            @media screen and (min-width: 1200px) {
                                display: block;
                            }
                        }
                        span {
                            color: $color-primary;
                        }
                        strong {
                            font-weight: bold;
                        }
                    }
                }
            }
        }
    }
}
</style>
