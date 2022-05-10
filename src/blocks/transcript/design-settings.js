import {__} from '@wordpress/i18n';

const {addFilter} = wp.hooks;
const {createHigherOrderComponent} = wp.compose;
const {Fragment} = wp.element;
const {InspectorControls} = wp.editor;
const {PanelBody, ColorPicker, BaseControl, RangeControl, ToggleControl} = wp.components;

const designSettings = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        // Do nothing if it's not our block
        if ('create-block/castos-transcript' !== props.name) {
            return (
                <BlockEdit {...props} />
            );
        }

        const {titleColor, titleSize, titleBg, openContent} = props.attributes;
        const {contentColor, contentSize, contentBg} = props.attributes;

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody
                        title={__('Title Settings')}
                        initialOpen={true}
                    >
                        <ToggleControl
                            label={__('Open Content By Default')}
                            checked={openContent}
                            onChange={(val) => {
                                props.setAttributes({
                                    openContent: val,
                                });
                            }}
                        />
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
                        <BaseControl label={__('Title background')}>
                            <ColorPicker
                                disableAlpha={false}
                                oldHue={titleBg}
                                color={titleBg}
                                onChangeComplete={(selectedColor) => {
                                    props.setAttributes({
                                        titleBg: selectedColor.hex,
                                    });
                                }}
                            />
                        </BaseControl>
                    </PanelBody>
                    <PanelBody title={__('Content Settings')}>
                        <BaseControl label={__('Content text color')}>
                            <ColorPicker
                                disableAlpha={false}
                                oldHue={contentColor}
                                color={contentColor}
                                onChangeComplete={(selectedColor) => {
                                    props.setAttributes({
                                        contentColor: selectedColor.hex,
                                    });
                                }}
                            />
                        </BaseControl>
                        <RangeControl
                            label={__('Content text size')}
                            initialPosition={titleSize}
                            min={6}
                            max={60}
                            onChange={(size) => {
                                props.setAttributes({
                                    contentSize: size,
                                });
                            }}
                        />
                        <BaseControl label={__('Content background')}>
                            <ColorPicker
                                disableAlpha={false}
                                oldHue={contentBg}
                                color={contentBg}
                                onChangeComplete={(selectedColor) => {
                                    props.setAttributes({
                                        contentBg: selectedColor.hex,
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
