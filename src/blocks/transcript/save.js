import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';

export default function save({attributes}) {
    const blockProps = useBlockProps.save(),
    title = attributes.hasOwnProperty('title') ? attributes.title : __('Transcript', 'seriously-simple-transcripts');

    return <div {...blockProps}>
        <div className="ssp-transcript">
            <div className="row">
                <div className="col">
                    <div className="tabs">
                        <div className="tab">
                            <input type="checkbox" id="chck1" />
                            <label className="tab-label ssp-transcript-title" htmlFor="chck1">{title}</label>
                            <div className="tab-content ssp-transcript-content">
                                {attributes.content}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>;
}
