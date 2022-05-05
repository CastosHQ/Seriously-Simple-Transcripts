import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';
import {template} from "./template";

export default function save({attributes}) {
    const blockProps = useBlockProps.save(),
        title = attributes.hasOwnProperty('title') ? attributes.title : __('Transcript', 'seriously-simple-transcripts');

    return <div {...blockProps}>
        {template({attributes: attributes, title: title})}
    </div>;
}
