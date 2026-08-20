<template>
    <div class="listadoServiciosSection">
        <div class="container">
            <div class="headerContainer">
                <div>
                    <div class="etiquetaContainer">
                        <span>{{ dataListado.etiqueta }}</span>
                    </div>
                    <h2 v-html="dataListado.title"></h2>
                </div>
                <div>
                    <div class="imgContainer">
                        <img :src="dataListado.imagen" />
                    </div>
                </div>
            </div>
            <div class="bodyContainer">
                <div>
                    <div
                        class="cardServicio"
                        v-for="(item, index) in dataListado.items"
                        :key="index"
                    >
                        <div class="iconCard">
                            <img :src="item.icon" />
                        </div>
                        <div class="descripcionCard" v-html="item.title"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
defineProps({
    dataListado: {
        type: Object,
        required: true,
    },
});
</script>
<style lang="scss" scoped>
.listadoServiciosSection {
    background: white;
    padding: 0rem 0 5rem;
    overflow: hidden;
    .bodyContainer {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
        > div {
            &:nth-of-type(1) {
                grid-column: 1 / -1;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
                @media screen and (min-width: 992px) {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                    grid-column: 1 / span 9;
                }
                .cardServicio {
                    border: 1px solid #cdcdcd;
                    padding: 1rem 0.5rem;
                    border-radius: 20px;
                    display: flex;
                    justify-content: flex-start;
                    align-items: center;
                    flex-direction: column;
                    gap: 0.5rem;
                    @media screen and (min-width: 992px) {
                        padding: 1rem 1.5rem;
                        flex-direction: row;
                        justify-content: flex-start;
                        align-items: center;
                    }
                    .iconCard {
                        flex: 0 0 50px;
                        img {
                            width: auto;
                            height: auto;
                            object-fit: contain;
                        }
                    }
                    .descripcionCard {
                        flex: 1;
                        color: $color-text-light;
                        font-size: 0.9rem;
                        line-height: 1.25em;
                        font-family: $font-sans;
                        font-weight: 500;
                        margin: 1rem 0 0.5rem;
                        text-align: center;
                        @media screen and (min-width: 992px) {
                            font-size: 0.9rem;
                            line-height: 1.5em;
                            text-align: left;
                        }

                        @media screen and (min-width: 1200px) {
                            font-size: 1rem;
                            line-height: 1.5em;
                        }
                    }
                }
            }
        }
    }
    .headerContainer {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1rem;
        > div {
            &:nth-of-type(1) {
                grid-column: 1 / span 9;
                padding-top: 5rem;
            }
            &:nth-of-type(2) {
                grid-column: 10 / -1;
                position: relative;
                .imgContainer {
                    position: absolute;
                    top: 0;
                    left: 0;
                    opacity: 0;
                    @media screen and (min-width: 992px) {
                        opacity: 1;
                    }
                }
            }
        }
        h2 {
            font-size: 1.75rem;
            line-height: 1.25em;
            color: $color-text-light;
            font-family: $font-archia;
            font-weight: 500;
            margin: 1rem 0 0.5rem;

            @media screen and (min-width: 992px) {
                font-size: 1.825rem;
                line-height: 1.25em;
            }

            @media screen and (min-width: 1200px) {
                font-size: 1.875rem;
                line-height: 1.25em;
            }
        }
        .etiquetaContainer {
            border: 1px solid $color-primary-light;
            border-radius: 30px;
            min-width: 216px;
            padding: 0 1rem;
            height: 34px;
            display: inline-block;
            text-align: center;

            span {
                font-size: 0.9rem;
                line-height: 2.35em;
                color: $color-primary-light;
                font-family: $font-red;
                font-weight: 600;

                @media screen and (min-width: 1200px) {
                    font-size: 1rem;
                    line-height: 2em;
                }
            }
        }
    }
}
</style>
