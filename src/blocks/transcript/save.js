import {useBlockProps} from '@wordpress/block-editor';
import {blockTemplate} from "./edit";

export default function save({attributes}) {
    const blockProps = useBlockProps.save();

    return <div {...blockProps}>
        {blockTemplate({attributes: attributes})}
    </div>;
}
