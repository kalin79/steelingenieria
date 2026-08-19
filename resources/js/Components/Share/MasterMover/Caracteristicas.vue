<template>
    <div class="caracteristicaSection">
        <div class="container">
            <div class="headerContainer">
                <div>
                    <div class="etiquetaBox">
                        <span>{{ caracteristicas.subtitulo }}</span>
                    </div>
                    <h2 v-html="caracteristicas.titulo"></h2>
                </div>
                <div>
                    <div
                        class="descripcionBox"
                        v-html="caracteristicas.descripcion"
                    ></div>
                </div>
            </div>
            <div class="bodyContainer">
                <div
                    class="cardBox"
                    v-for="(item, index) in caracteristicas.items"
                    :key="index"
                >
                    <div class="iconBox">
                        <img :src="item.icono" />
                    </div>
                    <p v-html="item.descripcion"></p>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
// RECIBIR PROPS del backend
const props = defineProps({
    caracteristicas: {
        type: Object,
    },
});
</script>
<style lang="scss" scoped>
.caracteristicaSection {
    padding: 5rem 0;
    background-image: url("/images/f2.webp");
    background-position: top right;
    background-size: cover;
    background-repeat: repeat;
    .bodyContainer {
        margin-top: 3rem;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        @media screen and (min-width: 992px) {
            grid-template-columns: repeat(4, 1fr);
        }
        .cardBox {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 0.5rem;
            p {
                font-size: 0.95rem;
                line-height: 1.15em;
                color: $color-text-light;
                font-family: $font-sans;
                font-weight: 400;
                margin: 1rem 0 0.5rem;
                @media screen and (min-width: 992px) {
                    font-size: 1rem;
                    line-height: 1.25em;
                }
                @media screen and (min-width: 1200px) {
                    font-size: 1rem;
                    line-height: 1.25em;
                }
            }
            .iconBox {
                flex: 0 0 64px;
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
