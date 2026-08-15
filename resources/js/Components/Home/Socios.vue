<template>
    <section class="sectionSocio">
        <div class="bgSocio"></div>
        <div class="container">
            <div class="layoutContainer">
                <div>
                    <div class="etiquetaContainer">
                        <span>Socios Comerciales</span>
                    </div>
                    <div class="titularContainer">
                        <h2>
                            Soluciones de Movilidad <br />
                            Indistrial
                        </h2>
                    </div>
                </div>
                <div>
                    <div class="descriptionContainer">
                        <p>
                            <span>Soluciones especializadas</span> para
                            optimizar la movilidad, seguridad y productividad de
                            las operaciones industriales.
                        </p>
                    </div>
                </div>
                <div>
                    <div class="cardSocio">
                        <div class="cardImage">
                            <img src="/images/so1.webp" />
                        </div>
                        <div class="cardInfo">
                            <h2>Mueva más. Esfuércese menos</h2>
                            <p>
                                Los remolcadores eléctricos MasterMover
                                transforman la manipulación de cargas pesadas en
                                una operación segura, precisa y eficiente,
                                optimizando cada movimiento dentro de su planta.
                            </p>
                            <div class="itemsContainer">
                                <div class="item">
                                    <div class="iconContainer">
                                        <img src="/images/ico1.svg" />
                                    </div>
                                    <div class="iconInfo">
                                        <p>
                                            Capacidad de arrastre hasta 120,000
                                            kg
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="iconContainer">
                                        <img src="/images/ico2.svg" />
                                    </div>
                                    <div class="iconInfo">
                                        <p>Aumenta la eficiencia operativa</p>
                                    </div>
                                </div>
                            </div>
                            <div class="botonContainer">
                                <Link href=""
                                    ><span>MÁS INFORMACIÓN</span></Link
                                >
                            </div>
                        </div>
                    </div>
                    <div class="cardSocio">
                        <div class="cardImage">
                            <img src="/images/so2.webp" />
                        </div>
                        <div class="cardInfo">
                            <h2>Movilidad que impulsa el rendimiento</h2>
                            <p>
                                TENTE desarrolla soluciones de movilidad
                                diseñadas para optimizar procesos, proteger
                                equipos y garantizar un desplazamiento seguro en
                                los entornos más exigentes.
                            </p>
                            <div class="itemsContainer">
                                <div class="item">
                                    <div class="iconContainer">
                                        <img src="/images/ico3.svg" />
                                    </div>
                                    <div class="iconInfo">
                                        <p>Ingeniería Alemana de precisión</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="iconContainer">
                                        <img src="/images/ico4.svg" />
                                    </div>
                                    <div class="iconInfo">
                                        <p>
                                            Opciones especializadas higiénicas y
                                            antiestáticas
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="botonContainer">
                                <Link href=""
                                    ><span>MÁS INFORMACIÓN</span></Link
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<style lang="scss" scoped>
.sectionSocio {
    background: $color-text-light;
    position: relative;
    z-index: 9;
    padding: 1rem 0 5rem;
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
            padding: 5rem 0 3rem;
        }
        > div {
            &:nth-of-type(3) {
                grid-column: 1 / -1;
                display: flex;
                justify-content: flex-start;
                align-items: flex-start;
                gap: 2rem;
                margin-top: 3rem;
                flex-direction: column;
                @media screen and (min-width: 992px) {
                    flex-direction: row;
                    margin-top: 5rem;
                    gap: 1rem;
                }
                .cardSocio {
                    flex: 1;
                    background: $color-primary-dark;
                    border-radius: 30px;
                    overflow: hidden;
                    padding-bottom: 3rem;
                    .botonContainer {
                        display: flex;
                        justify-content: flex-end;
                        // border: 1px solid red;
                        margin-top: 2rem;
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
                    .cardInfo {
                        padding: 1rem 2rem 1rem 2rem;
                        @media screen and (min-width: 992px) {
                            padding: 3rem 2rem 1rem 2rem;
                        }
                        .itemsContainer {
                            display: flex;
                            justify-content: flex-start;
                            gap: 1rem;
                            margin-top: 1.5rem;
                            .item {
                                flex: 1 1;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                flex-direction: column;
                                gap: 0.5rem;
                                @media screen and (min-width: 992px) {
                                    flex-direction: row;
                                    justify-content: flex-start;
                                }
                                .iconInfo {
                                    flex: 1;
                                    p {
                                        font-size: 0.9rem;
                                        line-height: 1.35em;
                                        color: white;
                                        font-family: $font-sans;
                                        font-weight: 400;
                                        text-align: center;
                                        @media screen and (min-width: 992px) {
                                            font-size: 0.95rem;
                                            line-height: 1.35em;
                                            text-align: left;
                                        }
                                        @media screen and (min-width: 1200px) {
                                            font-size: 1rem;
                                            line-height: 1.25em;
                                        }
                                        br {
                                            display: none;
                                        }
                                    }
                                }
                                .iconContainer {
                                    flex: 0 0 60px;
                                }
                            }
                        }
                        p {
                            font-size: 0.95rem;
                            line-height: 1.5em;
                            color: white;
                            font-family: $font-sans;
                            font-weight: 400;
                            @media screen and (min-width: 992px) {
                                font-size: 0.95rem;
                                line-height: 1.5em;
                            }
                            @media screen and (min-width: 1200px) {
                                font-size: 1.125rem;
                                line-height: 1.5em;
                            }
                        }
                        h2 {
                            font-size: 1rem;
                            line-height: 1.35em;
                            color: $color-primary-light;
                            font-family: $font-sans;
                            font-weight: 500;
                            margin-bottom: 0.5rem;
                            @media screen and (min-width: 992px) {
                                font-size: 1rem;
                                line-height: 1.35em;
                            }
                            @media screen and (min-width: 1200px) {
                                font-size: 1.25rem;
                                line-height: 1.5em;
                            }
                        }
                    }
                    .cardImage {
                        height: 300px;
                        overflow: hidden;
                        padding: 1rem;
                        @media screen and (min-width: 992px) {
                            height: 478px;
                            padding: 0rem;
                        }
                        img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            object-position: bottom;
                            border-radius: 20px;
                            overflow: hidden;
                            @media screen and (min-width: 992px) {
                                border-radius: 0px;
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
                    padding-top: 0rem;
                    @media screen and (min-width: 992px) {
                        padding-top: 3.85rem;
                    }
                    @media screen and (min-width: 1200px) {
                        padding-top: 3.5rem;
                    }
                    p {
                        font-size: 1.25rem;
                        line-height: 1.35em;
                        color: white;
                        font-family: $font-sans;
                        font-weight: 400;
                        @media screen and (min-width: 992px) {
                            font-size: 1.25rem;
                            line-height: 1.35em;
                        }
                        @media screen and (min-width: 1200px) {
                            font-size: 1.5rem;
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
                        color: white;
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
