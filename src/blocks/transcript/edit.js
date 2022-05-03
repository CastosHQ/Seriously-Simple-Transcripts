import {Placeholder, TextControl, TextareaControl} from '@wordpress/components';
import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';
import './editor.scss';

export default function Edit({attributes, isSelected, setAttributes}) {
    let title = attributes.hasOwnProperty('title') ? attributes.title : __('Transcript', 'seriously-simple-transcripts');

    return (
        <div {...useBlockProps()}>
            {attributes.content && !isSelected ? (
                <div className="ssp-transcript">
                    <div className="row">
                        <div className="col">
                            <div className="tabs">
                                <div className="tab">
                                    <input type="checkbox" id="chck1"/>
                                    <label className="tab-label ssp-transcript-title" htmlFor="chck1">{title}</label>
                                    <div className="tab-content ssp-transcript-content">
                                        {attributes.content}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
