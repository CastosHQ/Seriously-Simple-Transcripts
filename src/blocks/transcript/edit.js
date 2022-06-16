import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';
import './editor.scss';
import './settings.js';

const {RichText} = wp.blockEditor;

export default function edit({attributes, isSelected, setAttributes}) {
    return (
        <div {...useBlockProps()}>
            {blockTemplate({attributes: attributes, isSelected: isSelected, setAttribute: setAttributes})}
        </div>
    );
}

export function blockTemplate({attributes, isSelected = false, setAttribute = null}) {
    let title = attributes.hasOwnProperty('title') ? attributes.title : __('Transcript', 'seriously-simple-transcripts');
    const {hideTitle, showContent, content} = attributes;

    return (
        <div className="ssp-transcript">
            <div className="row">
                <div className="col">
                    <div className="tabs">
                        {isSelected ? (
                            <div className="tab">
                                <input type="checkbox" id="chck1" checked={true} onChange={() => {
                                }}/>
                                <RichText
                                    className="tab-label ssp-transcript-title"
                                    onChange={(val) => {
                                        setAttribute({
                                            title: val
                                        })
                                    }}
                                    value={title}
                                    style={getTitleStyle(attributes)}
                                />
                                <RichText
                                    className="tab-content ssp-transcript-content"
                                    onChange={(val) => {
                                        setAttribute({
                                            content: val
                                        })
                                    }}
                                    value={content}
                                    style={getContentStyle(attributes)}
                                />
                            </div>
                        ) : (
                            <div className="tab">
                                <input type="checkbox" id="chck1" checked={hideTitle || showContent} onChange={() => {
                                }}/>
                                <label className="tab-label ssp-transcript-title"
                                       htmlFor="chck1"
                                       style={getTitleStyle(attributes)}
                                ><RichText.Content value={ title } /></label>
                                <div className="tab-content ssp-transcript-content"
                                     style={getContentStyle(attributes)}>
                                    <RichText.Content value={ content } />
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );

    function getTitleStyle(attributes) {
        let style = {};
        const attributeSettings = wp.data.select('core/blocks').getBlockType('create-block/castos-transcript').attributes;

        const {titleColor, titleBg, titleSize, hideTitle} = attributes;

        if (hideTitle) {
            style['display'] = 'none';
            return style;
        }

        if (titleColor !== attributeSettings.titleColor.default) {
            style['color'] = titleColor;
        }

        if (titleBg !== attributeSettings.titleBg.default) {
            style['background'] = titleBg;
        }

        if (titleSize !== attributeSettings.titleSize.default) {
            style['fontSize'] = titleSize + 'px';
        }

        return style;
    }

    function getContentStyle(attributes) {
        let style = {};
        const attributeSettings = wp.data.select('core/blocks').getBlockType('create-block/castos-transcript').attributes;

        const {contentColor, contentBg, contentSize} = attributes;

        if (contentColor !== attributeSettings.contentColor.default) {
            style['color'] = contentColor;
        }

        if (contentBg !== attributeSettings.contentBg.default) {
            style['background'] = contentBg;
        }

        if (contentSize !== attributeSettings.contentSize.default) {
            style['fontSize'] = contentSize + 'px';
        }

        return style;
    }
}
