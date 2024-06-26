import {__} from '@wordpress/i18n';

const {addFilter} = wp.hooks;
const {createHigherOrderComponent} = wp.compose;
const {Fragment} = wp.element;
const {InspectorControls} = wp.blockEditor;
const {PanelBody, ColorPicker, BaseControl, RangeControl, ToggleControl} = wp.components;

const blockSettings = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        // Do nothing if it's not our block
        if ('create-block/castos-transcript' !== props.name) {
            return (
                <BlockEdit {...props} />
            );
        }

        const {titleColor, titleSize, titleBg, showContent, hideTitle} = props.attributes;
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
                            label={__('Hide Title')}
                            checked={hideTitle}
                            onChange={(val) => {
                                props.setAttributes({
                                    hideTitle: val,
                                });
                            }}
                        />

                        {!hideTitle ?
                            <ToggleControl
                                label={__('Show Content By Default')}
                                checked={showContent}
                                onChange={(val) => {
                                    props.setAttributes({
                                        showContent: val,
                                    });
                                }}
                            /> : ''}

                        {!hideTitle ?
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
                            : ''}

                        {!hideTitle ?
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
                            : ''}

                        {!hideTitle ?
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
                            : ''}
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
                            initialPosition={contentSize}
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
}, 'blockSettings');

addFilter('editor.BlockEdit', 'extend-block/transcript-block-settings', blockSettings);
