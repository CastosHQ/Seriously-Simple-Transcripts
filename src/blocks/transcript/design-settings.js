import {__} from '@wordpress/i18n';

const {addFilter} = wp.hooks;
const {createHigherOrderComponent} = wp.compose;
const {Fragment} = wp.element;
const {InspectorControls} = wp.editor;
const {PanelBody, ColorPicker, BaseControl, RangeControl} = wp.components;

const enableControlOnBlocks = [
    'create-block/castos-transcript',
];

const designSettings = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        // Do nothing if it's another block than our defined ones.
        if (!enableControlOnBlocks.includes(props.name)) {
            return (
                <BlockEdit {...props} />
            );
        }

        const {titleColor, titleSize, panelBg} = props.attributes;

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody
                        title={__('Design Settings')}
                        initialOpen={true}
                    >
                        <BaseControl label={__('Title color')}>
                            <ColorPicker
                                disableAlpha={false}
                                oldHue={titleColor}
                                color={titleColor}
                                onChangeComplete={(selectedColor) => {
                                    props.setAttributes({
                                        titleColor: selectedColor.hex,
                                    });
                                }}
                            />
                        </BaseControl>
                        <RangeControl
                            label={__('Title size')}
                            initialPosition={titleSize}
                            min={6}
                            max={60}
                            onChange={(size) => {
                                props.setAttributes({
                                    titleSize: size,
                                });
                            }}
                        />
                        <BaseControl label={__('Panel background')}>
                            <ColorPicker
                                disableAlpha={false}
                                oldHue={panelBg}
                                color={panelBg}
                                onChangeComplete={(selectedColor) => {
                                    props.setAttributes({
                                        panelBg: selectedColor.hex,
                                    });
                                }}
                            />
                        </BaseControl>
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    };
}, 'designSettings');

addFilter('editor.BlockEdit', 'extend-block/transcript-design-settings', designSettings);
