<template>
    <div class="lineasSection">
        <div class="container">
            <div class="headerContainer">
                <div>
                    <h2 v-html="lineas.titulo"></h2>
                </div>
                <div>
                    <div
                        class="descripcionBox"
                        v-html="lineas.descripcion"
                    ></div>
                </div>
            </div>
            <div class="bodyContainer">
                <div
                    class="productCard"
                    v-for="(product, index) in lineas.productos"
                    :key="index"
                >
                    <div class="headerBox">
                        <img :src="product.imagen" />
                    </div>
                    <div class="bodyCard">
                        <h3 v-html="product.subtitulo"></h3>
                        <h2 v-html="product.titulo"></h2>
                    </div>
                    <div class="footerCard">
                        <div
                            class="itemBox"
                            v-for="(item, index2) in product.items"
                            :key="index2"
                        >
                            <div class="infoBox">
                                <h4>{{ item.titulo }}:</h4>
                                <h5 v-html="item.descripcion"></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
// RECIBIR PROPS del backend
const props = defineProps({
    lineas: {
        type: Object,
    },
});
</script>
<style lang="scss" scoped>
.lineasSection {
    padding: 5rem 0 2rem;
    background: #fff;
    .bodyContainer {
        margin-top: 5rem;
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1rem;
        @media screen and (min-width: 768px) {
            grid-template-columns: repeat(2, 1fr);
        }

        @media screen and (min-width: 992px) {
            grid-template-columns: repeat(3, 1fr);
        }

        @media screen and (min-width: 1400px) {
            grid-template-columns: repeat(4, 1fr);
        }
        .productCard {
            background: $color-primary-dark;
            border-radius: 30px;
            overflow: hidden;
            padding: 2.5rem 1.5rem;
            .headerBox {
                height: 190px;
                display: flex;
                justify-content: center;
                img {
                    height: auto;
                    width: auto;
                    object-fit: contain;
                }
            }
            .bodyCard {
                margin: 1rem 0 2rem;
                h3 {
                    font-size: 0.875rem;
                    line-height: 1.5em;
                    color: $color-secondary;
                    font-family: $font-sans;
                    font-weight: 500;
                    @media screen and (min-width: 992px) {
                        font-size: 0.875rem;
                        line-height: 1.5em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 0.875rem;
                        line-height: 1.5em;
                    }
                }
                h2 {
                    font-size: 1.875rem;
                    line-height: 1em;
                    color: white;
                    font-family: $font-sans;
                    font-weight: 400;
                    @media screen and (min-width: 992px) {
                        font-size: 1.875rem;
                        line-height: 1em;
                    }
                    @media screen and (min-width: 1200px) {
                        font-size: 1.875rem;
                        line-height: 1em;
                    }
                }
            }
            .footerCard {
                background: white;
                border-radius: 20px;
                overflow: hidden;
                padding: 2rem 1.5rem;
                .itemBox {
                    display: flex;
                    justify-content: flex-start;
                    align-items: center;
                    gap: 0.5rem;
                    .infoBox {
                        display: flex;
                        justify-content: flex-start;
                        align-items: flex-start;
                        gap: 0.5rem;
                        h5 {
                            font-size: 1rem;
                            line-height: 1.5em;
                            color: #878787;
                            font-family: $font-sans;
                            font-weight: 400;
                            @media screen and (min-width: 992px) {
                                font-size: 1rem;
                                line-height: 1.5em;
                            }
                            @media screen and (min-width: 1200px) {
                                font-size: 1rem;
                                line-height: 1.5em;
                            }
                            :deep(span) {
                                color: $color-text-light;
                            }
                        }
                        h4 {
                            font-size: 1rem;
                            line-height: 1.5em;
                            color: $color-text-light;
                            font-family: $font-sans;
                            font-weight: 400;
                            @media screen and (min-width: 992px) {
                                font-size: 1rem;
                                line-height: 1.5em;
                            }
                            @media screen and (min-width: 1200px) {
                                font-size: 1rem;
                                line-height: 1.5em;
                            }
                        }
                    }
                    .iconBox {
                        flex: 0 0 22px;
                        display: flex;
                        justify-content: center;
                        img {
                            width: auto;
                            height: auto;
                            object-fit: contain;
                        }
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
            &:nth-of-type(2) {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                justify-content: flex-end;
                .descripcionBox {
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
                }
            }
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
                .etiquetaBox {
                    border: 1px solid $color-primary-light;
                    border-radius: 30px;
                    min-width: 156px;
                    height: 34px;
                    display: inline-block;
                    text-align: center;
                    margin-bottom: 0.5rem;
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
