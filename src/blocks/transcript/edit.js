import {Placeholder, TextControl, TextareaControl} from '@wordpress/components';
import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';
import './editor.scss';
import {template} from './template';
import './design-settings.js';


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
