import {Placeholder, TextControl, TextareaControl} from '@wordpress/components';
import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';
import './editor.scss';
import {template} from './template';

export default function edit({attributes, isSelected, setAttributes}) {
    let title = attributes.hasOwnProperty('title') ? attributes.title : __('Transcript', 'seriously-simple-transcripts');

    return (
        <div {...useBlockProps()}>
            {attributes.content && !isSelected ? (
                template({attributes: attributes, title: title})
            ) : (
                <Placeholder label={__('Castos Transcript', 'seriously-simple-transcripts')}>
                    <TextControl
                        label={__('Title', 'seriously-simple-transcripts')}
                        value={title}
                        onChange={(val) => setAttributes({title: val})}
                    />
                    <TextareaControl
                        label={__('Content', 'seriously-simple-transcripts')}
                        value={attributes.content || ''}
                        onChange={(val) => setAttributes({content: val})}
                        rows="10"
                    />
                </Placeholder>
            )}
        </div>
    );
}


const {addFilter} = wp.hooks;
const {createHigherOrderComponent} = wp.compose;
const {Fragment} = wp.element;
const {InspectorControls} = wp.editor;
const {PanelBody, ColorPicker, BaseControl} = wp.components;

const enableSpacingControlOnBlocks = [
    'create-block/castos-transcript',
];

const designSettings = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        // Do nothing if it's another block than our defined ones.
        if (!enableSpacingControlOnBlocks.includes(props.name)) {
            return (
                <BlockEdit {...props} />
            );
        }

        const {spacing, titleColor, panelBg} = props.attributes;

        // add has-spacing-xy class to block
        if (spacing) {
            props.attributes.className = `has-spacing-${spacing}`;
        }

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody
                        title={__('Design Settings')}
                        initialOpen={true}
                    >
                        <BaseControl label={__('Panel background')}>
                            <ColorPicker
                                disableAlpha={false}
                                oldHue={panelBg}
                                color={props.attributes.panelBg}
                                onChangeComplete={(selectedColor) => {
                                    props.setAttributes({
                                        panelBg: selectedColor.hex,
                                    });
                                }}
                            />
                        </BaseControl>
                        <BaseControl label={__('Title color')}>
                            <ColorPicker
                                disableAlpha={false}
                                oldHue={titleColor}
                                color={props.attributes.titleColor}
                                onChangeComplete={(selectedColor) => {
                                    props.setAttributes({
                                        titleColor: selectedColor.hex,
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

addFilter('editor.BlockEdit', 'extend-block-example/with-spacing-control', designSettings);
